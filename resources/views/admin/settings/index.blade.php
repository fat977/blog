@extends('layouts.admin')
@section('title', __('admin/setting/setting.pages.index'))
@push('css')
    <link rel="stylesheet" href="{{ asset('css/previewImage.css') }}">
@endpush
@section('content')
    @if (session()->has('success'))
        <p class="alert alert-success" role="alert">
            {{ session('success') }}</p>
    @endif
    @if (session()->has('error'))
        <p class="alert alert-danger">{{ session('error') }}</p>
    @endif
    <div class="card shadow-sm">
        <div class="card-header bg-dark">
            {{ __('admin/setting/setting.pages.index') }}
        </div>
        <div class="card-body">
            <div class="col-12">
                <div class="card card-dark card-outline card-outline-tabs">
                    <div class="card-header p-0 pt-1 bg-gray-light">
                        <ul class="nav nav-tabs" id="settings" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link  {{ $errors->hasAny(['app_name', 'site_description', 'site_logo', 'site_status', 'reason_locked']) ? 'bg-danger' : '' }}"
                                    id="general-settings-tab" data-toggle="pill" href="#general-settings" role="tab"
                                    aria-controls="general-settings" aria-selected="true">{{ __('admin/setting/setting.extra.general_settings') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $errors->hasAny(['google_client_id', 'google_client_secret', 'facebook_client_id', 'facebook_client_secret']) ? 'bg-danger' : '' }}"
                                    id="login-settings-tab" data-toggle="pill" href="#login-settings" role="tab"
                                    aria-controls="login-settings" aria-selected="false">{{ __('admin/setting/setting.extra.login_applications') }} </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $errors->hasAny(['mail_mailer', 'mail_host', 'mail_port', 'mail_username', 'mail_password', 'mail_from_address', 'mail_from_name']) ? 'bg-danger' : '' }}"
                                    id="smtp-settings-tab" data-toggle="pill" href="#smtp-settings" role="tab"
                                    aria-controls="smtp-settings" aria-selected="false">{{ __('admin/setting/setting.extra.smtp') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $errors->hasAny(['recaptcha_site_key', 'recaptcha_secret_key']) ? 'bg-danger' : '' }}"
                                    id="recaptcha-settings-tab" data-toggle="pill" href="#recaptcha-settings" role="tab"
                                    aria-controls="recaptcha-settings" aria-selected="false">{{ __('admin/setting/setting.extra.captcha') }} </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $errors->hasAny(['telegram_chat_id', 'telegram_token', 'slack_url']) ? 'bg-danger' : '' }}"
                                    id="error-report-settings-tab" data-toggle="pill" href="#error-report-settings"
                                    role="tab" aria-controls="error-report-settings" aria-selected="false"> 
                                    {{ __('admin/setting/setting.extra.report') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="additional-settings-tab" data-toggle="pill"
                                    href="#additional-settings" role="tab" aria-controls="additional-settings"
                                    aria-selected="false">{{ __('admin/setting/setting.extra.additional_settings') }}
                                    </a>
                            </li>
                            <li
                                class="nav-item {{ $errors->hasAny(['load_password', 'resetdb_password']) ? 'bg-danger' : '' }}">
                                <a class="nav-link" id="cleanup-tab" data-toggle="pill" href="#cleanup" role="tab"
                                    aria-controls="cleanup" aria-selected="false">{{ __('admin/setting/setting.extra.cleanup') }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <form method="POST" action={{ route('admin.settings.store') }} enctype="multipart/form-data">
                            @csrf
                            <div class="tab-content" id="settingsContent">
                                <div class="tab-pane fade show active" id="general-settings" role="tabpanel"
                                    aria-labelledby="general-settings-tab">
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="app_name">{{ __('admin/setting/setting.fields.app_name') }}</label>
                                                <input type="text" name="app_name" class="form-control" id="app_name"
                                                    placeholder="{{ __('admin/setting/setting.extra.enter_name') }}"
                                                    value="{{ old('app_name') ?? $settings['app.name'] }}">
                                                @error('app_name')
                                                    <p class="text-danger small">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="">
                                                <label for="site_logo">{{ __('admin/setting/setting.fields.site_logo') }}</label>
                                                <div class="img-preview">
                                                    <input type="file" id="file-1" accept="image/*" name="site_logo">
                                                    <label for="file-1" id="file-1-preview" class="w-100 h-100">
                                                        <img src={{ asset('storage/' . $settings['site_logo']) }}
                                                            alt="">
                                                        <div>
                                                            <span>+</span>
                                                        </div>
                                                    </label>
                                                </div>
                                                @error('site_logo')
                                                    <p class="text-danger small">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="site_description">{{ __('admin/setting/setting.fields.site_description') }}</label>
                                            <textarea class="form-control" id="site_description" rows="10" name="site_description"
                                                placeholder="{{ __('admin/setting/setting.extra.enter_text') }}">{{ old('site_description') ?? $settings['site_description'] }}</textarea>
                                            @error('site_description')
                                                <p class="text-danger small">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <label for="site_status">{{ __('admin/setting/setting.fields.site_status') }}</label>
                                        <select class="form-control col-md-2" name="site_status" id="site_status">
                                            <option value="active" @selected(old('site_status') == 'active' || $settings['site_status'] == 'active')>
                                                {{ __('admin/setting/setting.extra.open') }}
                                            </option>
                                            <option value="inactive" @selected(old('site_status') == 'inactive' || $settings['site_status'] == 'inactive')>
                                                {{ __('admin/setting/setting.extra.close') }}
                                            </option>
                                        </select>
                                        <div class="form-group mt-4" id="reason_locked_div">
                                            <label for="reason_locked">{{ __('admin/setting/setting.extra.reason_locked') }}</label>
                                            <textarea class="form-control ckeditor" id="reason_locked" row="3" name="reason_locked"
                                                placeholder="{{ __('admin/setting/setting.extra.enter_reason_locked') }}">{{ old('reason_locked') ?? $settings['reason_locked'] }}</textarea>
                                            @error('reason_locked')
                                                <p class="text-danger small">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="login-settings" role="tabpanel"
                                    aria-labelledby="login-settings-tab">
                                    <div>
                                        <div class="d-flex align-items-center">
                                            <input type="text" name="facebook_enable" value="off" hidden />
                                            <div class="custom-control custom-switch mt-2">
                                                <input type="checkbox" class="custom-control-input" id="facebook_enable"
                                                    name="facebook_enable" @checked(old('facebook_enable') == 'on' || $settings['facebook_enable'] === 'on')>
                                                <label class="custom-control-label" for="facebook_enable">{{ __('admin/setting/setting.fields.facebook_enable') }}</label>
                                            </div>
                                        </div>
                                        <div class="form-row mt-2" id="facebook_enable_div">
                                            <div class="form-group col-md-6">
                                                <label for="facebook_client_id" class="text-muted">{{ __('admin/setting/setting.fields.services_facebook_client_id') }}</label>
                                                <input type="text" name="facebook_client_id" class="form-control"
                                                    id="facebook_client_id" placeholder="{{ __('admin/setting/setting.extra.enter_services_facebook_client_id') }}"
                                                    value="{{ old('facebook_client_id') ?? $settings['services.facebook.client_id'] }}">
                                                @error('facebook_client_id')
                                                    <p class="text-danger small">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="facebook_client_secret" class="text-muted">{{ __('admin/setting/setting.fields.services_facebook_client_secret') }}
                                                    </label>
                                                <input type="text" name="facebook_client_secret" class="form-control"
                                                    id="facebook_client_secret" placeholder="{{ __('admin/setting/setting.extra.enter_services_facebook_client_secret') }}"
                                                    value="{{ old('facebook_client_secret') ?? $settings['services.facebook.client_secret'] }}">
                                                @error('facebook_client_secret')
                                                    <p class="text-danger small">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <input type="text" name="google_enable" value="off" hidden />
                                        <div class="custom-control custom-switch mt-2">
                                            <input type="checkbox" class="custom-control-input" id="google_enable"
                                                name="google_enable" @checked(old('google_enable') == 'on' || $settings['google_enable'] === 'on')>
                                            <label class="custom-control-label" for="google_enable">{{ __('admin/setting/setting.fields.google_enable') }}</label>
                                        </div>
                                        <div class="form-row mt-2" id="google_enable_div">
                                            <div class="form-group col-md-6">
                                                <label for="google_client_id" class="text-muted">{{ __('admin/setting/setting.fields.services_google_client_id') }}</label>
                                                <input type="text" name="google_client_id" class="form-control"
                                                    id="google_client_id" placeholder="{{ __('admin/setting/setting.extra.enter_services_google_client_id') }}"
                                                    value="{{ old('google_client_id') ?? $settings['services.google.client_id'] }}">
                                                @error('google_client_id')
                                                    <p class="text-danger small">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="google_client_secret" class="text-muted">{{ __('admin/setting/setting.fields.services_google_client_secret') }}
                                                    </label>
                                                <input type="text" name="google_client_secret" class="form-control"
                                                    id="google_client_secret" placeholder="{{ __('admin/setting/setting.extra.enter_services_google_client_secret') }}"
                                                    value="{{ old('google_client_secret') ?? $settings['services.google.client_secret'] }}">
                                                @error('google_client_secret')
                                                    <p class="text-danger small">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="smtp-settings" role="tabpanel"
                                    aria-labelledby="smtp-settings-tab">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="mail_mailer" class="text-muted">{{ __('admin/setting/setting.fields.mail_default') }}</label>
                                            <select class="form-control" name="mail_mailer" id="mail_mailer">
                                                @foreach (App\Enums\MailerType::values() as $key => $value)
                                                    <option value="{{ $key }}" @selected(old('mail_mailer') == $key || $settings['mail.default'] == $key)>
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('mail_mailer')
                                                <p class="text-danger small">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="mail_host" class="text-muted">{{ __('admin/setting/setting.fields.mail_mailers_smtp_host') }}</label>
                                            <input type="text" name="mail_host" class="form-control" id="mail_host"
                                                placeholder="{{ __('admin/setting/setting.extra.mail_mailers_smtp_host') }}"
                                                value="{{ old('mail_host') ?? $settings['mail.mailers.smtp.host'] }}">
                                            @error('mail_host')
                                                <p class="text-danger small">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="mail_port" class="text-muted">{{ __('admin/setting/setting.fields.mail_mailers_smtp_port') }}</label>
                                            <input type="text" name="mail_port" class="form-control" id="mail_port"
                                                placeholder="{{ __('admin/setting/setting.extra.mail_mailers_smtp_port') }}"
                                                value="{{ old('mail_port') ?? $settings['mail.mailers.smtp.port'] }}">
                                            @error('mail_port')
                                                <p class="text-danger small">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row mt-3">
                                        <div class="form-group col-md-6">
                                            <label for="mail_username" class="text-muted">{{ __('admin/setting/setting.fields.mail_mailers_smtp_username') }}</label>
                                            <input type="text" name="mail_username" class="form-control"
                                                id="mail_username" placeholder="{{ __('admin/setting/setting.extra.mail_mailers_smtp_username') }}"
                                                value="{{ old('mail_username') ?? $settings['mail.mailers.smtp.username'] }}">
                                            @error('mail_username')
                                                <p class="text-danger small">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="mail_password" class="text-muted">{{ __('admin/setting/setting.fields.mail_mailers_smtp_password') }}</label>
                                            <input type="password" class="form-control" id="mail_password"
                                                name="mail_password" value="****" placeholder="{{ __('admin/setting/setting.extra.mail_mailers_smtp_password') }}">
                                            @error('mail_password')
                                                <p class="text-danger small">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row mt-3">
                                        <div class="form-group col-md-6">
                                            <label for="mail_from_address" class="text-muted">{{ __('admin/setting/setting.fields.mail_from_address') }}</label>
                                            <input type="text" name="mail_from_address" class="form-control"
                                                id="mail_from_address" placeholder="{{ __('admin/setting/setting.extra.mail_from_address') }}"
                                                value="{{ old('mail_from_address') ?? $settings['mail.from.address'] }}">
                                            @error('mail_from_address')
                                                <p class="text-danger small">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="mail_from_name" class="text-muted">{{ __('admin/setting/setting.fields.mail_from_name') }}</label>
                                            <input type="text" name="mail_from_name" class="form-control"
                                                id="mail_from_name" placeholder="{{ __('admin/setting/setting.extra.mail_from_name') }}"
                                                value="{{ old('mail_from_name') ?? $settings['mail.from.name'] }}">
                                            @error('mail_from_name')
                                                <p class="text-danger small">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row mt-3">
                                        <div class="form-group col-md-6">
                                            <button type="button" class="mx-1 btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#confirm-test-email">
                                                {{ __('admin/setting/setting.extra.confirm_test_email') }}  
                                                <i class="fas fa-info"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="recaptcha-settings" role="tabpanel"
                                    aria-labelledby="recaptcha-settings-tab">
                                    <div>
                                        <input type="text" name="captcha_enable" value="off" hidden />
                                        <div class="custom-control custom-switch mt-2">
                                            <input type="checkbox" class="custom-control-input" id="captcha_enable"
                                                name="captcha_enable" @checked(old('captcha_enable') == 'on' || $settings['captcha_enable'] === 'on')>
                                            <label class="custom-control-label" for="captcha_enable">
                                                {{ __('admin/setting/setting.fields.captcha_enable') }}</label>
                                        </div>
                                    </div>
                                    <div class="form-row mt-2" id="captcha_enable_div">
                                        <div class="form-group col-md-6">
                                            <label for="recaptcha_site_key" class="text-muted"> {{ __('admin/setting/setting.fields.recaptcha_api_site_key') }}</label>
                                            <input type="text" name="recaptcha_site_key" class="form-control"
                                                id="recaptcha_site_key" placeholder="{{ __('admin/setting/setting.extra.recaptcha_api_site_key') }}"
                                                value="{{ old('recaptcha_site_key') ?? $settings['recaptcha.api_site_key'] }}">
                                            @error('recaptcha_site_key')
                                                <p class="text-danger small">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="recaptcha_secret_key" class="text-muted"> {{ __('admin/setting/setting.fields.recaptcha_api_secret_key') }}</label>
                                            <input type="text" name="recaptcha_secret_key" class="form-control"
                                                id="recaptcha_secret_key" placeholder="{{ __('admin/setting/setting.extra.recaptcha_api_secret_key') }}"
                                                value="{{ old('recaptcha_secret_key') ?? $settings['recaptcha.api_secret_key'] }}">
                                            @error('recaptcha_secret_key')
                                                <p class="text-danger small">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="error-report-settings" role="tabpanel"
                                    aria-labelledby="error-report-tab">
                                    <div>
                                        <input type="text" name="telegram_report_enable" value="off" hidden />
                                        <div class="custom-control custom-switch mt-2">
                                            <input type="checkbox" class="custom-control-input"
                                                id="telegram_report_enable" name="telegram_report_enable"
                                                @checked($settings['telegram_report_enable'] === 'on')>
                                            <label class="custom-control-label"
                                                for="telegram_report_enable">{{ __('admin/setting/setting.fields.telegram_report_enable') }}</label>
                                        </div>
                                        <div class="form-row mt-2" id="telegram_report_enable_div">
                                            <div class="form-group col-md-6">
                                                <label for="telegram_chat_id" class="text-muted">{{ __('admin/setting/setting.fields.telegram_chat_id') }}</label>
                                                <input type="text" name="telegram_chat_id" class="form-control"
                                                    id="telegram_chat_id" placeholder="{{ __('admin/setting/setting.extra.telegram_chat_id') }}"
                                                    value="{{ old('telegram_chat_id') ?? $settings['logging.channels.telegram.chat_id'] }}">
                                                @error('telegram_chat_id')
                                                    <p class="text-danger small">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="telegram_token" class="text-muted">{{ __('admin/setting/setting.fields.logging_channels_telegram_token') }}</label>
                                                <input type="text" name="telegram_token" class="form-control"
                                                    id="telegram_token" placeholder="{{ __('admin/setting/setting.extra.logging_channels_telegram_token') }}"
                                                    value="{{ old('telegram_token') ?? $settings['logging.channels.telegram.token'] }}">
                                                @error('telegram_token')
                                                    <p class="text-danger small">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="d-flex align-items-center">
                                            <input type="text" name="slack_report_enable" value="off" hidden />
                                            <div class="custom-control custom-switch mt-2">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="slack_report_enable" name="slack_report_enable"
                                                    @checked(old('slack_report_enable') == 'on' || $settings['slack_report_enable'] === 'on')>
                                                <label class="custom-control-label" for="slack_report_enable">{{ __('admin/setting/setting.fields.slack_report_enable') }}</label>
                                            </div>
                                        </div>
                                        <div class="form-row mt-2" id="slack_report_enable_div">
                                            <div class="form-group col-md-6">
                                                <label for="slack_url" class="text-muted">{{ __('admin/setting/setting.fields.logging_channels_slack_url') }}</label>
                                                <input type="text" name="slack_url" class="form-control"
                                                    id="slack_url" placeholder="{{ __('admin/setting/setting.extra.logging_channels_slack_url') }}"
                                                    value="{{ old('slack_url') ?? $settings['logging.channels.slack.url'] }}">
                                                @error('slack_url')
                                                    <p class="text-danger small">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-row mt-3">
                                            <div class="form-group col-md-6">
                                                <button type="button" class="mx-1 btn btn-danger btn-sm"
                                                    data-toggle="modal" data-target="#confirm-test-report-channel">
                                                    {{ __('admin/setting/setting.extra.confirm-test-report-channel') }}
                                                    <i class="fas fa-info"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="form-row mt-3">
                                            <div class="form-group col-md-6">
                                                {{ __('admin/setting/setting.extra.web_status') }}: {{ app()->environment() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="additional-settings" role="tabpanel"
                                    aria-labelledby="additional-settings-tab">
                                    <div>
                                        <h5 class="text-muted mb-3">{{ __('admin/setting/setting.extra.add_cancel_features') }}</h5>
                                        <div class="custom-control custom-switch mt-2">
                                            <input type="checkbox" class="custom-control-input" id="faq-status"
                                                name="faq_enable" value="{{ $settings['faq_enable'] }}"
                                                @checked($settings['faq_enable'] == 'on')>
                                            <label class="custom-control-label" for="faq-status">{{ __('admin/setting/setting.fields.faq_enable') }}</label>
                                        </div>
                                        <div class="custom-control custom-switch mt-2">
                                            <input type="checkbox" class="custom-control-input" id="article-status"
                                                name="article_enable" value="{{ $settings['article_enable'] }}"
                                                @checked($settings['article_enable'] == 'on')>
                                            <label class="custom-control-label" for="article-status">{{ __('admin/setting/setting.fields.article_enable') }}</label>
                                        </div>
                                        <div class="custom-control custom-switch mt-2">
                                            <input type="checkbox" class="custom-control-input" id="page-status"
                                                name="page_enable" value="{{ $settings['page_enable'] }}"
                                                @checked($settings['page_enable'] == 'on')>
                                            <label class="custom-control-label" for="page-status">{{ __('admin/setting/setting.fields.page_enable') }}</label>
                                        </div>
                                        <div class="custom-control custom-switch mt-2">
                                            <input type="text" name="short_link_enable" value="off" hidden />
                                            <input type="checkbox" class="custom-control-input" id="short_link_enable"
                                                name="short_link_enable" @checked(old('short_link_enable') == 'on' || $settings['short_link_enable'] === 'on')>
                                            <label class="custom-control-label" for="short_link_enable">{{ __('admin/setting/setting.fields.short_link_enable') }}
                                                </label>
                                        </div>
                                    </div>
                                    <div class="mt-5">
                                        <div class="custom-control custom-switch mt-2">
                                            <input type="checkbox" class="custom-control-input" id="register-status"
                                                name="register_enable" value="{{ $settings['register_enable'] }}"
                                                @checked($settings['register_enable'] == 'on')>
                                            <label class="custom-control-label" for="register-status">
                                                {{ __('admin/setting/setting.fields.register_enable') }}</label>
                                        </div>
                                        <div class="custom-control custom-switch mt-2">
                                            <input type="text" name="email_confirm_enable" value="off" hidden />
                                            <input type="checkbox" class="custom-control-input" id="email_confirm_enable"
                                                name="email_confirm_enable" @checked(old('email_confirm_enable') == 'on' || $settings['email_confirm_enable'] === 'on')>
                                            <label class="custom-control-label" for="email_confirm_enable">{{ __('admin/setting/setting.fields.email_confirm_enable') }}
                                                    </label>
                                        </div>
                                        @feature('article')
                                            <div class="custom-control custom-switch mt-2">
                                                <input type="text" name="comment_enable" value="off" hidden />
                                                <input type="checkbox" class="custom-control-input" id="comment_enable"
                                                    name="comment_enable" @checked(old('comment_enable') == 'on' || $settings['comment_enable'] === 'on')>
                                                <label class="custom-control-label" for="comment_enable">
                                                    {{ __('admin/setting/setting.fields.comment_enable') }}</label>
                                            </div>
                                        @endfeature
                                    </div>

                                    <div class="mt-5">
                                        <h5 class="text-muted mb-3">{{ __('admin/setting/setting.extra.add_codes') }}</h5>
                                        <div class="form-group">
                                            <label for="header_script">{{ __('admin/setting/setting.fields.header_script') }}</label>
                                            <textarea class="form-control" id="header_script" rows="10" name="header_script"
                                                placeholder="{{ __('admin/setting/setting.extra.header_script') }}">{{ old('header_script') ?? $settings['header_script'] }}</textarea>
                                            @error('header_script')
                                                <p class="text-danger small">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="footer_script">{{ __('admin/setting/setting.fields.footer_script') }}</label>
                                            <textarea class="form-control" id="footer_script" rows="10" name="footer_script"
                                                placeholder="{{ __('admin/setting/setting.extra.footer_script') }}">{{ old('footer_script') ?? $settings['footer_script'] }}</textarea>
                                            @error('footer_script')
                                                <p class="text-danger small">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="cleanup" role="tabpanel" aria-labelledby="cleanup-tab">
                                    <button type="button" class="mx-1 btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#confirm-reset-db">
                                        {{ __('admin/setting/setting.buttons.confirm_reset') }}
                                        <i class="fas fa-info"></i>
                                    </button>
                                    <button type="button" class="mx-1 btn btn-success btn-sm" data-toggle="modal"
                                        data-target="#confirm-clear-session-cookie">
                                        {{ __('admin/setting/setting.buttons.confirm_clear_session_cookie') }}
                                        <i class="fas fa-info"></i>
                                    </button>
                                    <button type="button" class="mx-1 btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#confirm-clear-cache">
                                        {{ __('admin/setting/setting.buttons.clear_cache') }}
                                        <i class="fas fa-info"></i>
                                    </button>
                                    @if (Illuminate\Support\Facades\File::exists(base_path('config.php')))
                                        <button type="button" class="mx-1 btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#confirm-load">
                                            {{ __('admin/setting/setting.buttons.load') }}
                                            <i class="fas fa-info"></i>
                                        </button>
                                    @endif
                                    @if (app()->environment() == 'production')
                                        <button type="button" class="mx-1 btn btn-secondary btn-sm" data-toggle="modal"
                                            data-target="#confirm-prepare-production">
                                            {{ __('admin/setting/setting.buttons.prepare_production') }}
                                            <i class="fas fa-info"></i>
                                        </button>
                                    @endif
                                </div>
                            </div>
                            <button type="submit" class="btn btn-dark mt-4 d-inline-block">{{ __('admin/setting/setting.buttons.submit') }}</button>
                        </form>
                    </div>
                </div>
                <div class="modal fade" id="confirm-reset-db">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <p class="modal-title">{{ __('admin/setting/setting.extra.confirm_reset') }}</p>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-left">
                                <p>{{ __('admin/setting/setting.extra.Are you sure you want to reset') }}</p>
                            </div>
                            <div class="modal-footer justify-content-between">
                                {{-- <button type="button" class="btn btn-default btn-md" data-dismiss="modal">إغلاق</button> --}}
                                <form action="{{ route('admin.settings.cleanup', ['action' => 'reset-db']) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="row mb-3">
                                        <label for="resetdb_password"
                                            class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                        <div class="col-md-6">
                                            <input id="resetdb_password" type="password"
                                                class="form-control @error('resetdb_password') is-invalid @enderror"
                                                name="resetdb_password" autocomplete="current-password">

                                            @error('resetdb_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Confirm Password') }}
                                            </button>

                                            @if (Route::has('password.request'))
                                                <a class="btn btn-link" target="_blank"
                                                    href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                    {{-- <button type="submit" class="btn btn-dark btn-md">نعم</button> --}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="confirm-clear-session-cookie">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <p class="modal-title">{{ __('admin/setting/setting.extra.confirm_cleanup') }}</p>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-left">
                                <p>{{ __('admin/setting/setting.extra.Are you sure you want to cleanup') }}
                                </p>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default btn-md" data-dismiss="modal">{{ __('admin/setting/setting.extra.close') }}</button>
                                <form action="{{ route('admin.settings.cleanup', ['action' => 'clear-session-cookie']) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-dark btn-md">{{ __('admin/setting/setting.extra.yes') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="confirm-clear-cache">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <p class="modal-title">{{ __('admin/setting/setting.extra.confirm_delete_cache') }} </p>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-left">
                                <p>{{ __('admin/setting/setting.extra.Are you sure you want to delete cache') }}
                                </p>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default btn-md" data-dismiss="modal">{{ __('admin/setting/setting.extra.close') }}</button>
                                <form action="{{ route('admin.settings.cleanup', ['action' => 'clear-cache']) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-dark btn-md">{{ __('admin/setting/setting.extra.yes') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="confirm-load">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <p class="modal-title">{{ __('admin/setting/setting.extra.confirm_reload') }}</p>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-left">
                                <p>{{ __('admin/setting/setting.extra.Are you sure you want to reload') }}
                                </p>
                            </div>
                            <div class="modal-footer justify-content-between">
                                {{-- <button type="button" class="btn btn-default btn-md" data-dismiss="modal">إغلاق</button> --}}
                                <form action="{{ route('admin.settings.cleanup', ['action' => 'load-settings']) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="row mb-3">
                                        <label for="load_password"
                                            class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                        <div class="col-md-6">
                                            <input id="load_password" type="password"
                                                class="form-control @error('load_password') is-invalid @enderror"
                                                name="load_password" autocomplete="current-password">

                                            @error('load_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Confirm Password') }}
                                            </button>

                                            @if (Route::has('password.request'))
                                                <a class="btn btn-link" target="_blank"
                                                    href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                    {{-- <button type="submit" class="btn btn-dark btn-md">نعم</button> --}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="confirm-prepare-production">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <p class="modal-title">{{ __('admin/setting/setting.extra.confirm_launch') }}</p>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-left">
                                <p>{{ __('admin/setting/setting.extra.Are you sure you want to launch') }}</p>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default btn-md" data-dismiss="modal">{{ __('admin/setting/setting.extra.close') }}</button>
                                <form action="{{ route('admin.settings.prepare_production') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-dark btn-md">{{ __('admin/setting/setting.extra.yes') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="confirm-test-email">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <p class="modal-title">{{ __('admin/setting/setting.extra.confirm_test') }} </p>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-footer justify-content-center">
                                <form action="{{ route('admin.settings.test_report', ['action' => 'email']) }}"
                                    method="POST">
                                    @csrf
                                    <label for="test-email">{{ __('admin/setting/setting.extra.Are you sure you want to launch') }}</label>
                                    <input type="email" name="test_email" id="test-email"
                                        placeholder="example@example.com"
                                        class="form-control @error('test-email') is-invalid @enderror" />
                                    <div class="d-flex justify-content-between mt-5">
                                        <button type="button" class="btn btn-default btn-md"
                                            data-dismiss="modal">{{ __('admin/setting/setting.extra.close') }}</button>
                                        <button type="submit" class="btn btn-dark btn-md">{{ __('admin/setting/setting.extra.send') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="confirm-test-report-channel">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <p class="modal-title">{{ __('admin/setting/setting.extra.confirm_test_report') }}</p>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default btn-md" data-dismiss="modal">{{ __('admin/setting/setting.extra.close') }}</button>
                                <form action="{{ route('admin.settings.test_report', ['action' => 'report']) }}"
                                    method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-dark btn-md">{{ __('admin/setting/setting.extra.yes') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('js/previewImage.js') }}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
    <script src="{{ asset('plugins/bootstrap-switch/js/bootstrap-switch.min') }}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
    <script>
        $(document).ready(function() {
            if ($('#site_status').val() === 'inactive') {
                $('#reason_locked_div').show();
            } else {
                $('#reason_locked_div').hide();
            }

            if ($('#google_enable').is(':checked')) {
                $('#google_enable_div').show();
            } else {
                $('#google_enable_div').hide();
            }

            if ($('#facebook_enable').is(':checked')) {
                $('#facebook_enable_div').show();
            } else {
                $('#facebook_enable_div').hide();
            }

            if ($('#captcha_enable').is(':checked')) {
                $('#captcha_enable_div').show();
            } else {
                $('#captcha_enable_div').hide();
            }

            if ($('#telegram_report_enable').is(':checked')) {
                $('#telegram_report_enable_div').show();
            } else {
                $('#telegram_report_enable_div').hide();
            }

            if ($('#slack_report_enable').is(':checked')) {
                $('#slack_report_enable_div').show();
            } else {
                $('#slack_report_enable_div').hide();
            }

            $('#site_status').change(function() {
                var selectedValue = $(this).val();
                if (selectedValue === 'inactive') {
                    $('#reason_locked_div').show();
                } else {
                    $('#reason_locked_div').hide();
                }
            });

            $('#google_enable').change(function() {
                if ($(this).is(':checked')) {
                    $('#google_enable_div').show();
                } else {
                    $('#google_enable_div').hide();
                }
            });

            $('#facebook_enable').change(function() {
                if ($(this).is(':checked')) {
                    $('#facebook_enable_div').show();
                } else {
                    $('#facebook_enable_div').hide();
                }
            });

            $('#captcha_enable').change(function() {
                if ($(this).is(':checked')) {
                    $('#captcha_enable_div').show();
                } else {
                    $('#captcha_enable_div').hide();
                }
            });

            $('#telegram_report_enable').change(function() {
                if ($(this).is(':checked')) {
                    $('#telegram_report_enable_div').show();
                } else {
                    $('#telegram_report_enable_div').hide();
                }
            });

            $('#slack_report_enable').change(function() {
                if ($(this).is(':checked')) {
                    $('#slack_report_enable_div').show();
                } else {
                    $('#slack_report_enable_div').hide();
                }
            });
        });

        @if ($errors->has('resetdb_password'))
            $('#confirm-reset-db').modal('show');
        @endif
        @if ($errors->has('load_password'))
            $('#confirm-load').modal('show');
        @endif
        /* ClassicEditor
            .create(document.querySelector('#reason_locked'), {
                language: {
                    content: 'ar'
                },
            })
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            }); */
        ClassicEditor
            .create(document.querySelector('#header_script'), {
                language: {
                    content: 'ar'
                },
            });
        ClassicEditor
            .create(document.querySelector('#footer_script'), {
                language: {
                    content: 'ar'
                },
            });
    </script>
@endpush
