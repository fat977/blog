<?php

use App\Http\Controllers\Admin\CMS\Blog\ArticleController;
use App\Http\Controllers\Admin\CMS\Blog\Category\ArticleCategoryController;
use App\Http\Controllers\Admin\CMS\Blog\Comment\ArticleComment;
use App\Http\Controllers\Admin\CMS\Blog\Tag\TagController;
use App\Http\Controllers\Admin\CMS\Faq\Category\FaqCategory;
use App\Http\Controllers\Admin\CMS\Faq\FaqController;
use App\Http\Controllers\Admin\CMS\Page\PageController;
use App\Http\Controllers\Admin\FileUpload\FileUploadController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\Setting\CustomMessage\CustomMessageController;
use App\Http\Controllers\Admin\Setting\Payment\PaymentController;
use App\Http\Controllers\Admin\Setting\SettingController;
use App\Http\Controllers\Admin\ShortLink\ShortLinkController;
use App\Http\Controllers\Admin\Support\Category\TicketCategoryController;
use App\Http\Controllers\Admin\Support\TicketsController;
use App\Http\Controllers\Admin\User\LoginActivityController;
use App\Http\Controllers\Admin\User\RoleController;
use App\Http\Controllers\Admin\User\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(['auth', 'check_user', /* 'roles:admin' */])->as('admin.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');

    // users
    Route::group([], function () {
        Route::group(['prefix' => 'users'], function () {
            Route::get('/verify/{id}', [UserController::class, 'verifyEmail'])->name('users.verifyEmail');
            Route::get('/{user}/activities', [UserController::class, 'activities'])->name('users.activities')->withTrashed();
            Route::post('/{user}/delete-activities', [UserController::class, 'deleteActivities'])->name('users.deleteActivities');

            Route::get('/{user_id}/email-history', [UserController::class, 'email_history'])->name('user.email_history');
            Route::get('/{user_id}/email-history/{email_id}', [UserController::class, 'email_show'])->name('user.email_show');
            Route::get('/login-activity', [LoginActivityController::class, 'index'])->name('login.activity')->middleware('auth');
            Route::resource('roles', RoleController::class)->except('show');
        });
        Route::resource('users', UserController::class)->withTrashed();
        
    });

    // CMS
    Route::group(['prefix' => 'cms'], function () {
        // Blog
        Route::group(['prefix' => 'blog'], function () {
            // articles
            Route::group([], function () {
                Route::group(['prefix' => 'articles', 'middleware' => 'feature:article'], function () {
                    Route::resource('articles', ArticleController::class);
                    Route::resource('articles-categories', ArticleCategoryController::class);
                    Route::resource('tags', TagController::class);
                    Route::group(['middleware' => 'feature:comment'], function () {
                        Route::resource('comments', ArticleComment::class);
                        Route::post('/restore_comments/{id}', [ArticleComment::class, 'restoreComments'])->name('restoreComments');
                    });

                });

                // Route::get('articles/categories/{slug}', [ArticleController::class, 'category'])->name('articles.category');
            });
        });
        Route::group(['middleware' => 'feature:page'], function () { 
            Route::resource('pages', PageController::class)->except(['show']);
            Route::patch('pages/{page}/active', [PageController::class, 'changeActive'])
                    ->name('pages.changeActive');
        });

        Route::group(['middleware' => 'feature:faq'], function () { 
            Route::resource('faqs', FaqController::class);
            Route::resource('faqs-categories', FaqCategory::class);
        });
    });

    Route::group(['prefix' => 'support'], function () {
        Route::resource('TicketsCategory', TicketCategoryController::class)->except(['show']);
        Route::resource('tickets', TicketsController::class);
    });

    // Settings
    Route::group([], function () {
        Route::group(['prefix' => 'settings'], function () {
            //Settings routes
            Route::name('settings.')->group(function () {
                Route::resource('/', SettingController::class)->only('index', 'store');
                Route::delete('cleanup', [SettingController::class, 'cleanup'])->name('cleanup');
                Route::post('prepare-production', [SettingController::class, 'prepare_production'])->name('prepare_production');
                Route::post('exception', [SettingController::class, 'test'])->name('test_report');
            });

            Route::patch('payments/{payment}/active', [PaymentController::class, 'changeActive'])
                ->name('payments.changeActive');

            Route::resource('payments', PaymentController::class);

            Route::group([], function () {
                Route::resource('custom-message', CustomMessageController::class)->except('show');
                Route::patch('custom-message/{msg}/active', [CustomMessageController::class, 'changeActive'])
                    ->name('custom-message.changeActive');
            });
        });
    });

    //short links
    Route::middleware('feature:short_link')->group(function () {
        Route::resource('short_links', ShortLinkController::class)->except('show');
        Route::get('short_links/{id}/statistics', [ShortLinkController::class, 'statistics'])->name('short_links.statistics');
    });

    Route::group([], function () {
        Route::get('uploads/{id}/download', [FileUploadController::class, 'download'])->name('uploads.download');
        Route::resource('uploads', FileUploadController::class)->except('show', 'edit', 'update');
    });
});
