@extends('layouts.admin')
@section('title')
{{ __('admin/CMS/faq/category/faq_category.pages.index') }}
@endsection
@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-dark">
            {{ __('admin/CMS/faq/category/faq_category.pages.edit') }}
        </div>
        <div class="card-body">
            <form action="{{ Route('admin.faqs-categories.update', $category->id) }}" method="post">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label>{{ __('admin/CMS/faq/category/faq_category.fields.name') }}</label>
                    <input type="text" name="name" value="{{ old('name', $category->name) }}" class="form-control">
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">{{ __('admin/CMS/faq/category/faq_category.buttons.edit') }}</button>
            </form>
        </div>
    </div>
@endsection
