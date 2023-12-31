@extends('layouts.admin')
@section('title')
{{ __('admin/setting/payment/payment.pages.create') }}
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('plugins\bootstrap-switch\css\bootstrap3\bootstrap-switch.min.css') }}">

    <style>
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
            {{ __('admin/setting/payment/payment.pages.create') }}
        </div>
        <div class="card-body">

            <form action="{{ Route('admin.payments.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row col-12">

                    <div class="form-group col-12">
                        <label>{{ __('admin/setting/payment/payment.fields.name') }}</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-12">
                        <label>{{ __('admin/setting/payment/payment.fields.description') }}</label>
                        <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-12">
                        <label for="logo" class="mb-4">{{ __('admin/setting/payment/payment.fields.logo') }}</label>
                        <div class="img-preview">
                            <input type="file" id="file-1" accept="image/*" name="logo">
                            <label for="file-1" id="file-1-preview" class="w-100 h-100">
                                {{-- <img src={{ asset('storage/' . $settings->site_logo) ?? 'https://bit.ly/3ubuq5o' }}
                                    alt=""> --}}
                                <div>
                                    <span>+</span>
                                </div>
                            </label>
                        </div>
                        @error('logo')
                            <p class="text-danger small">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group col-12 mr-3 custom-control custom-switch my-4">
                        <input type="checkbox" class="custom-control-input" id="is-active" name="is_active">
                        <label class="custom-control-label" for="is-active">{{ __('admin/setting/payment/payment.fields.is_active') }}</label>
                    </div>

                    <div class="form-group col-12">
                        <label>{{ __('admin/setting/payment/payment.fields.settings') }}</label>
                        <textarea name="settings" id="settings" class="form-control">{{ old('settings') }}</textarea>
                        @error('settings')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-sm btn-primary">
                            {{ __('admin/setting/payment/payment.buttons.create') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('js/previewImage.js') }}"></script>
    <!-- Bootstrap Switch -->
    <script src="{{ asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
    <script>
        // $(document).ready(function() {
        //     $("[data-bootstrap-switch]").bootstrapSwitch();
        // });

        $(function() {

            $("input[data-bootstrap-switch]").each(function() {
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            })

        })
    </script>
@endpush
