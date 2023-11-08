@extends('layouts.admin')
@section('title', __('admin/shortlink/shortlink.pages.edit'))
@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-dark">
            {{ __('admin/shortlink/shortlink.pages.edit') }}
        </div>
        @if (session()->has('error'))
            <p class="alert alert-danger">{{ session('error') }}</p>
        @endif
        <div class="card-body">
            <form action="{{ Route('admin.short_links.update', $short_link->id) }}" method="post">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label>{{ __('admin/shortlink/shortlink.fields.url') }}</label>
                    <input type="text" name="url" value="{{ $short_link->url }}" class="form-control">
                    @error('url')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label>{{ __('admin/shortlink/shortlink.fields.slug') }}</label>
                    <input type="text" name="slug" value="{{ $short_link->slug }}" class="form-control">
                    @error('slug')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">{{ __('admin/shortlink/shortlink.buttons.edit') }}</button>
            </form>
        </div>
    </div>
@endsection
