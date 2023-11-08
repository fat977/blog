<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="sidebar">
        <div class="user-pan e mt-3 pb-3 mb-3 d-f lex text-white">
            <div class="info text-center">
                <img src="{{ auth()->user()->avatar_image }}" style="border-radius: 50%" width="60px" height="60px">
                <p class="text-center m-3">{{ auth()->user()->name }}</p>
                @foreach (auth()->user()->roles as $role)
                    <span class="badge bg-black">{{ $role->name }}</span>
                @endforeach
            </div>

        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item @if (Route::is('admin.index')) ? 'active' : '' bg-primary @endif">
                    <a href="{{ route('admin.index') }}" class="nav-link">
                        <i class="nav-icon fa-solid fa-house"></i>
                        <p>
                            {{ __('admin/home.menu.home')}} 
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ Route::is('admin.users.*') || Route::is('admin.roles.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa-solid fa-user"></i>
                        <p>
                            {{ __('admin/users/user.menu.manage_users')}} 
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item @if (!request()->has('trashed') && Route::is('admin.users.*') && !request('role')) ? 'active' : '' bg-primary @endif">
                            <a class="nav-link" href="{{ route('admin.users.index') }}">
                                <i class="far fa-address-book nav-icon"></i>
                                <p>{{ __('admin/users/user.menu.users')}}</p>
                            </a>
                        </li>
                        <li class="nav-item @if (Route::is('admin.users.index') && request('role') === 'admin') ? 'active' : '' bg-primary @endif">
                            <a class="nav-link" href="{{ url('/admin/users?role=' . 'admin') }}">
                                <i class="far fa-solid fa-user-secret  nav-icon"></i>
                                <p>{{ __('admin/users/user.menu.admin_users')}}</p> 
                            </a>
                        </li>
                        <li class="nav-item @if (Route::is('admin.users.index') && request()->has('trashed')) ? 'active' : '' bg-primary @endif">
                            <a class="nav-link" href="{{ url('/admin/users?trashed') }}">
                                <i class="fa-solid fa-trash-can-arrow-up nav-icon"></i>
                                <p>{{ __('admin/users/user.menu.deleted_users')}}</p>
                            </a>
                        </li>
                        <li class="nav-item @if (Route::is('admin.roles.*')) ? 'active' : '' bg-primary @endif">
                            <a class="nav-link" href="{{ route('admin.roles.index') }}">
                                <i class="fa fa-tasks nav-icon"></i>
                                <p>{{ __('admin/users/role.menu')}}</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{--  @if (\App\Models\Setting::where('name', 'article_enable')?->first()?->value == 'on') --}}

                <li
                    class="nav-item {{ Route::is('admin.articles.*')|| Route::is('admin.faqs-categories.*') || Route::is('admin.faqs.*')  || Route::is('admin.articles-categories.*') || Route::is('admin.comments.*') || Route::is('admin.deletedComments') || Route::is('admin.tags.*') || Route::is('admin.pages.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa-solid fa-newspaper"></i>
                        <p>
                            {{ __('admin/cms/blog/article.menu.content')}} 
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li
                            class="nav-item {{ Route::is('admin.articles.*') || Route::is('admin.articles-categories.*') || Route::is('admin.comments.*') || Route::is('admin.deletedComments') || Route::is('admin.tags.*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa-solid fa-newspaper"></i>
                                <p>
                                    {{ __('admin/cms/blog/article.menu.blog')}}  
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @feature('article')
                                    <li
                                        class="nav-item @if (Route::is('admin.articles.*')) ? 'active' : '' bg-primary @endif">
                                        <a class="nav-link" href="{{ route('admin.articles.index') }}">
                                            <i class="fa fa-list-alt nav-icon"></i>
                                            <p>{{ __('admin/cms/blog/article.menu.articles')}} </p>
                                        </a>
                                    </li>
                                    @feature('comment')
                                        <li
                                            class="nav-item {{ Route::is('admin.articles.*') || Route::is('admin.comments.*') || Route::is('admin.deletedComments') ? 'menu-open' : '' }}">
                                            <a href="#" class="nav-link">
                                                <i class="nav-icon fa-solid fa-comment"></i>
                                                <p>
                                                    {{ __('admin/cms/blog/comment/article_comment.menu.comments')}}
                                                    <i class="fas fa-angle-left right"></i>
                                                </p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                <li
                                                    class="nav-item @if (!request()->has('deleted') && Route::is('admin.comments.*')) ? 'active' : '' bg-primary @endif">
                                                    <a class="nav-link" href="{{ route('admin.comments.index') }}">
                                                        <i class="fa fa-comment nav-icon"></i>
                                                        <p>{{ __('admin/cms/blog/comment/article_comment.menu.show_comments')}}</p> 
                                                    </a>
                                                </li>
                                                <li
                                                    class="nav-item @if (Route::is('admin.comments.index') && request()->has('deleted')) ? 'active' : '' bg-primary @endif">
                                                    <a class="nav-link" href="{{ url('/admin/cms/blog/articles/comments?deleted') }}">
                                                        <i class="fa fa-comment nav-icon"></i>
                                                        <p>{{ __('admin/cms/blog/comment/article_comment.menu.deleted_comments')}}</p>  
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    @endfeature
                                    <li
                                        class="nav-item @if (Route::is('admin.articles-categories.*')) ? 'active' : '' bg-primary @endif">
                                        <a class="nav-link" href="{{ route('admin.articles-categories.index') }}">
                                            <i class="fa fa-tag nav-icon"></i>
                                            <p>{{ __('admin/cms/blog/category/article_category.menu')}}</p>
                                        </a>
                                    </li>
                                @endfeature
                                @feature('page')
                                    <li
                                        class="nav-item @if (Route::is('admin.tags.*')) ? 'active' : '' bg-primary @endif">
                                        <a class="nav-link" href="{{ route('admin.tags.index') }}">
                                            <i class="fa fa-tag nav-icon"></i>
                                            <p>{{ __('admin/cms/blog/tag/tag.menu')}}</p>
                                        </a>
                                    </li>
                                @endfeature
                            </ul>
                        </li>
                        
                        @feature('page')
                            <li class="nav-item @if (Route::is('admin.pages.*')) ? 'active' : '' bg-primary @endif">
                                <a class="nav-link" href="{{ route('admin.pages.index') }}">
                                    <i class="nav-icon fa-solid fa-file"></i>
                                    <p>{{ __('admin/cms/page/page.menu')}}</p>
                                </a>
                            </li>
                        @endfeature

                        @feature('faq')
                            <li class="nav-item {{ Route::is('admin.faqs-categories.*') || Route::is('admin.faqs.*') ? 'menu-open' : '' }}">
                                <a class="nav-link" href="#">
                                    <i class="nav-icon fa-solid fa-question"></i>  
                                    <p>
                                        {{ __('admin/cms/faq/faq.menu.faq_manage')}}
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li
                                        class="nav-item @if (Route::is('admin.faqs.*')) ? 'active' : '' bg-primary @endif">
                                        <a class="nav-link" href="{{ route('admin.faqs.index') }}">
                                            <i class="fa-solid fa-question nav-icon"></i>
                                            <p>{{ __('admin/cms/faq/faq.menu.faq')}}</p> 
                                        </a>
                                    </li>
                                    <li
                                        class="nav-item @if (Route::is('admin.faqs-categories.*')) ? 'active' : '' bg-primary @endif">
                                        <a class="nav-link" href="{{ route('admin.faqs-categories.index') }}">
                                            <i class="fa fa-tag nav-icon"></i>
                                            <p>{{ __('admin/cms/faq/category/faq_category.menu')}}</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endfeature
                    </ul>

                </li>
                {{-- @endif --}}

                <li class="nav-item @if (Route::is('admin.tickets.*')) ? 'active' : '' bg-primary @endif ">
                    <a href={{ route('admin.tickets.index') }} class="nav-link">
                        <i class="nav-icon fa-solid fa-message"></i>
                        <p>{{ __('admin/support/ticket.menu')}}</p>
                    </a>
                </li>

                @feature('short_link')
                    <li class="nav-item">
                        <a class="nav-link @if (Route::is('admin.short_links*')) ? 'active' : '' bg-primary @endif"
                            href="{{ route('admin.short_links.index') }}">
                            <i class="nav-icon fa fa-link"></i>
                            <p>{{ __('admin/shortlink/shortlink.menu')}}</p>
                        </a>
                    </li>
                @endfeature

                <li class="nav-item">
                    <a class="nav-link" href="{{ asset('/log-viewer') }}">
                        <i class="nav-icon fa fa-exclamation-triangle"></i>
                        <p>ملف الاخطاء</p>

                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if (Route::is('admin.uploads.*')) ? 'active' : '' bg-primary @endif"
                        href="{{ route('admin.uploads.index') }}">
                        <i class="nav-icon fa-solid fa-download"></i>
                        <p>{{ __('admin/file_upload/file_upload.menu')}}</p>

                    </a>
                </li>

                <li
                    class="nav-item {{ Route::is('admin.settings.*') || Route::is('admin.payments.*') || Route::is('admin.TicketsCategory.*') || Route::is('admin.custom-message.*') || Route::is('admin.tags.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa-solid fa-cog"></i>
                        <p>
                            {{ __('admin/setting/setting.menu')}}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item @if (Route::is('admin.settings.*')) ? 'active' : '' bg-primary @endif">
                            <a href="{{ route('admin.settings.index') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-cog"></i>
                                <p>
                                    {{ __('admin/setting/setting.menu')}}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item {{ Route::is('admin.custom-message.*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa-solid fa-message"></i>
                                <p>
                                    {{ __('admin/setting/custom_message/custom_message.menu.custom_messages')}}
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li
                                    class="nav-item @if (Route::is('admin.custom-message.index')) ? 'active' : '' bg-primary @endif">
                                    <a href={{ route('admin.custom-message.index') }} class="nav-link">
                                        <i class="fa fa-commenting nav-icon"></i>
                                        <p>{{ __('admin/setting/custom_message/custom_message.menu.all')}} </p>
                                    </a>
                                </li>


                            </ul>
                        </li>
                        <li class="nav-item {{ Route::is('admin.TicketsCategory.*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa-solid fa-newspaper"></i>
                                <p>
                                    {{ __('admin/support/category/ticket_category.menu.support')}}
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li
                                    class="nav-item @if (Route::is('admin.TicketsCategory.*')) ? 'active' : '' bg-primary @endif ">
                                    <a href={{ route('admin.TicketsCategory.index') }} class="nav-link">
                                        <i class="nav-icon fa-solid fa-message"></i>
                                        <p>{{ __('admin/support/category/ticket_category.menu.ticket_category')}}</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item @if (Route::is('admin.payments.*')) ? 'active' : '' bg-primary @endif ">
                            <a href="{{ route('admin.payments.index') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-credit-card"></i>
                                <p>{{ __('admin/setting/payment/payment.menu')}}</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                        <i class="fa-solid fa-sign-out mr-1" style="font-size: 1.2rem"></i>
                        <p>{{ __('admin/home.menu.logout')}}</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
