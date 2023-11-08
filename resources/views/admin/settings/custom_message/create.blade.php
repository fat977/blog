@extends('layouts.admin')

@section('title', __('admin/setting/custom_message/custom_message.pages.create'))
{{-- @push('css')
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
@endpush --}}
@section('content')
    <a href={{ route('admin.custom-message.index') }} class="btn btn-info float-right mb-2"> {{ __('admin/setting/custom_message/custom_message.buttons.index') }}</a>
    <div class="clearfix"></div>
    @if (session()->has('success'))
        <p class="alert alert-success" role="alert">{{ session('success') }}</p>
    @endif
    @if (session()->has('error'))
        <p class="alert alert-danger">{{ session('error') }}</p>
    @endif
    <div class="card shadow-sm">
        <div class="card-header bg-dark">
            {{ __('admin/setting/custom_message/custom_message.pages.create') }}
        </div>
        <div class="card-body">
            <form id="quickForm" method="POST" action={{ route('admin.custom-message.store') }}>
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="code">{{ __('admin/setting/custom_message/custom_message.fields.code') }}</label>
                        <input type="text" name="code" class="form-control" id="code" placeholder="{{ __('admin/setting/custom_message/custom_message.extra.code') }}"
                            value="{{ old('code') }}">
                        @error('code')
                            <p class="text-danger small">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="subject">{{ __('admin/setting/custom_message/custom_message.fields.subject') }}</label>
                        <input type="text" name="subject" class="form-control" id="subject" placeholder="{{ __('admin/setting/custom_message/custom_message.extra.subject') }}"
                            value="{{ old('subject') }}">
                        @error('subject')
                            <p class="text-danger small">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="type">{{ __('admin/setting/custom_message/custom_message.fields.type') }}</label>
                        <select class="form-control" name="type" id="type">
                            <option value="">{{ __('admin/setting/custom_message/custom_message.extra.type') }}</option>
                            <option value="sms" {{ old('type') == 'sms' ? 'selected' : '' }}>sms</option>
                            <option value="email" {{ old('type') == 'email' ? 'selected' : '' }}>{{ __('admin/setting/custom_message/custom_message.extra.email') }}</option>
                        </select>
                        @error('type')
                            <p class="text-danger small">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="language">{{ __('admin/setting/custom_message/custom_message.fields.language') }}</label>
                        <select class="form-control" name="language" id="language">
                            <option value="">{{ __('admin/setting/custom_message/custom_message.extra.language') }}</option>
                            <option value="ar" {{ old('language') == 'ar' ? 'selected' : '' }}>{{ __('admin/setting/custom_message/custom_message.extra.arabic') }}</option>
                            <option value="en" {{ old('language') == 'en' ? 'selected' : '' }}>{{ __('admin/setting/custom_message/custom_message.extra.english') }}</option>
                        </select>
                        @error('language')
                            <p class="text-danger small">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="text">{{ __('admin/setting/custom_message/custom_message.fields.text') }}</label>
                    <textarea class="form-control ckeditor" id="text" rows="3" name="text" placeholder="{{ __('admin/setting/custom_message/custom_message.extra.text') }}">{{ old('text') }}</textarea>
                    @error('text')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group col-12 custom-control custom-switch my-4">
                    <input type="text" class="custom-control-input" name="is_active" value="off">
                    <input type="checkbox" class="custom-control-input" id="is-active" name="is_active">
                    <label class="custom-control-label" for="is-active">{{ __('admin/setting/custom_message/custom_message.fields.is_active') }}</label>
                </div>
                <button type="submit" class="btn btn-dark">{{ __('admin/setting/custom_message/custom_message.buttons.create') }}</button>
            </form>
        </div>
    </div>
@endsection
