@extends('layouts.admin')
@section('title')
{{ __('admin/CMS/faq/category/faq_category.pages.index') }}
@endsection
@section('content')
    <div class="container-fluid pt-3">

        <div class="card shadow-sm">
            <div class="card-header bg-dark">
                {{ __('admin/CMS/faq/category/faq_category.pages.create') }}
            </div>
            <div class="card-body">
                <form action="{{ Route('admin.faqs-categories.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>{{ __('admin/CMS/faq/category/faq_category.fields.name') }}</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-sm btn-primary">
                            {{ __('admin/CMS/faq/category/faq_category.buttons.create') }}</button>
                    </div>

            </div>
            </form>
        </div>
    </div>
@endsection
