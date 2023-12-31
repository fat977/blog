@extends('layouts.admin')
@section('title')
{{ __('admin/cms/blog/article.pages.create') }}
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: black;
        }

        .img-preview {
            width: 200px;
            height: 200px;
            box-shadow: 0px 0px 20px 5px rgba(100, 100, 100, 0.1);
        }

        .img-preview input {
            display: none;
        }

        .img-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .img-preview div {
            position: relative;
            height: 40px;
            margin-top: -40px;
            background: rgba(0, 0, 0, 0.5);
            text-align: center;
            line-height: 40px;
            font-size: 13px;
            color: #f5f5f5;
            font-weight: 600;
        }

        .img-preview div span {
            font-size: 40px;
        }
    </style>
@endpush

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-dark">
            {{ __('admin/cms/blog/article.pages.create') }}
        </div>
        <div class="card-body">

            <form action="{{ Route('admin.articles.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                <div class="row col-12">

                    <div class="form-group col-12">
                        <label>{{ __('admin/cms/blog/article.fields.title') }}</label>
                        <input type="text" name="title" value="{{ old('title') }}" class="form-control">
                        @error('title')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-12">
                        <label>{{ __('admin/cms/blog/article.fields.content') }}</label>
                        <textarea name="content" id="content" class="form-control ckeditor">{{ old('content') }}</textarea>
                        @error('content')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-12">
                        <label>{{ __('admin/cms/blog/article.fields.description') }}</label>
                        <textarea name="description" id="description" class="form-control ckeditor">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-12">
                        <label>{{ __('admin/cms/blog/article.fields.tags') }}</label>
                        <select class="select2" multiple="multiple" data-placeholder="{{ __('admin/cms/blog/article.extra.choose_tags') }}" name="tags[]"
                            style="width: 100%;">
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}"
                                    {{ collect(old('tags'))->contains($tag->id) ? 'selected' : '' }}>
                                    {{ $tag->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-12">
                        <label>{{ __('admin/cms/blog/article.fields.categories') }}</label>
                        <select class="select2" multiple="multiple" data-placeholder="{{ __('admin/cms/blog/article.extra.choose_categories') }}" name="categories[]"
                            style="width: 100%;">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ collect(old('categories'))->contains($category->id) ? 'selected' : '' }}>
                                    {{ $category->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-12">
                        <label for="logo" class="mb-4">{{ __('admin/cms/blog/article.fields.image') }}</label>
                        <div class="img-preview">
                            <input type="file" id="file-1" accept="image/*" name="image">
                            <label for="file-1" id="file-1-preview" class="w-100 h-100">
                                {{-- <img src={{ asset('storage/' . $settings->site_logo) ?? 'https://bit.ly/3ubuq5o' }}
                                    alt=""> --}}
                                <div>
                                    <span>+</span>
                                </div>
                            </label>
                        </div>
                        @error('image')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-sm btn-primary">
                            {{ __('admin/cms/blog/article.buttons.create') }}</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('js/previewImage.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()
        })
    </script>
@endpush
