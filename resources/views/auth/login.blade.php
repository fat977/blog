@extends('layouts.guest')
@section('content')
@section('title')
{{ __('auth/login.pages.index') }} 
@endsection
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8 bg-white p-3 col-11 rounded-top">
            <div class="form-header py-lg-4 px-lg-4 pb-3 shadow-sm">
                <div class="row align-items-end justify-content-center col-md-12">
                    <div class="line col-md-6 ol-sm-10 text-center mb-3 pt-lg-3">
                        <h4> {{ __('auth/login.pages.index') }}</h4>
                    </div>
                    {{--  <div class="row justify-content-center align-items-center mb-3">
                            <button type="button" class="btn btn-primary col-lg-5 col-sm-11 mx-2 mb-2 "> بإستخدام مايكروسوفت<i class="fa-brands fa-windows px-2"></i></button>
                            <button type="button" class="btn btn-danger col-lg-5 col-sm-11 mx-2 mb-2 "> بإستخدام جوجل<i class="fa-brands fa-google px-2"></i></button>
                        </div>  --}}
                    @include('components.app_login')
                </div>
                <form method="POST" action="{{ route('login') }}"
                    class="form-content text-end col-md-12 justify-content-center px-lg-4">
                    @csrf
                    <div class="row align-items-end justify-content-center px-3">

                        <label for="email" class="col-sm-11 col-lg-10 text-end fs-6 fw-bold">{{ __('auth/login.fields.email') }}<br>
                            <input type="text" name="email" value="{{ old('email') }}"
                                placeholder="{{ __('auth/login.extra.email') }}" id="email"
                                class="border w-100 py-2 px-2 my-1 text-end fs-6 rounded mt-3 mb-3">
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </label>

                        <label for="password" class="col-sm-11 col-lg-10 text-end py-1 fs-6 fw-bold">{{ __('auth/login.fields.password') }}<br>
                            <input type="password" name="password" placeholder="{{ __('auth/login.extra.password') }}" id="password"
                                class="border w-100 py-2 px-2 my-1 text-end fs-6 rounded mt-3 mb-3">
                            @error('password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </label>

                        <a href="{{ route('password.request') }}" class="text-center" style="text-decoration: none">
                            {{ __('auth/login.extra.forgot_password') }}</a>

                        <div class="d-flex justify-content-center m-3">
                            <button type="submit" class="btn btn-dark btn-lg px-5">{{ __('auth/login.buttons.login') }}</button>
                        </div>

                        <div class="text-center m-3">
                            <p class="mb-0 text-center">{{ __('auth/login.extra.donnot_have_account') }}<a href="{{ route('register') }}"
                                    class="text-primary-50 fw-bold">{{ __('auth/login.extra.create_account') }}</a>
                            </p>
                        </div>

                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
@include('partials.alerts')
@endpush
