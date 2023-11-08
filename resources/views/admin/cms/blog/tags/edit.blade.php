@extends('layouts.admin')
@section('title')
    {{ __('admin/cms/blog/tag/tag.pages.edit') }}
@endsection
@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-dark">
            {{ __('admin/cms/blog/tag/tag.pages.edit') }}
        </div>
        <div class="card-body">
            <form action="{{ Route('admin.tags.update', $tag->id) }}" method="post">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label>{{ __('admin/cms/blog/tag/tag.fields.name') }}</label>
                    <input type="text" name="name" value="{{ $tag->name }}" class="form-control">
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label>{{ __('admin/cms/blog/tag/tag.fields.slug') }} </label>
                    <input type="text" name="slug" value="{{ $tag->slug }}" class="form-control">
                    @error('slug')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">{{ __('admin/cms/blog/tag/tag.buttons.edit') }}</button>
            </form>
        </div>
    </div>
@endsection
