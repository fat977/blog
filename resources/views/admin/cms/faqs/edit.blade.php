@extends('layouts.admin')
@section('title')
{{ __('admin/CMS/faq/faq.pages.edit') }}
@endsection
@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-dark">
            {{ __('admin/CMS/faq/faq.pages.edit') }}
        </div>
        <div class="card-body">
            <form action="{{ Route('admin.faqs.update', $faq->id) }}" method="post">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label>{{ __('admin/CMS/faq/faq.fields.title') }}</label>
                    <input type="text" name="title" value="{{ $faq->title }}" class="form-control">
                    @error('title')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label> {{ __('admin/CMS/faq/faq.fields.answer') }}</label>
                    <textarea name="answer" id="answer" class="form-control ckeditor">{!! $faq->answer !!}</textarea>
                    @error('answer')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label>{{ __('admin/CMS/faq/faq.fields.categories') }}</label>
                    <select class="select2" multiple="multiple" name="categories[]" style="width: 100%;">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $faq->categories->contains('id', $category->id) || collect(old('categories'))->contains($category->id) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('categories')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">{{ __('admin/CMS/faq/faq.buttons.edit') }}</button>
            </form>
        </div>
    </div>
@endsection
