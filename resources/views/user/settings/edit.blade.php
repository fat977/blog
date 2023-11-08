@extends('layouts.user')
@section('title', __('user/setting/setting.pages.index'))
@section('content')
<div class="card shadow-sm">
    @if (session()->has('success'))
        <p class="alert alert-success" role="alert">{{ session('success') }}</p>
    @endif
    @if (session()->has('error'))
        <p class="alert alert-error" role="alert">{{ session('error') }}</p>
    @endif
    <div class="card-header bg-dark">
        {{__('user/setting/setting.extra.header')}}
    </div>
    <div class="card-body">
        <form action="{{ Route('user.profile.update', $user->id) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label>{{__('user/setting/setting.fields.email')}}</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control">
                @error('email')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>{{__('user/setting/setting.fields.avatar')}}</label>
                <input type="file" name="avatar" value="{{ $user->avatar }}" class="form-control">
                @if (!empty($user['avatar']))
                    <img src="{{ asset('storage/avatars/'.auth()->user()->avatar) }}" style="width:50px; height:50px" class="rounded circle">
                @endif
                @error('avatar')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-outline form-dark mb-2">
                <label>{{__('user/setting/setting.fields.current_password')}}</label>
                <input type="password" class="form-control py-2" name="current_password"/>

                @error('current_password')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-outline form-dark mb-2">
                <label>{{__('user/setting/setting.fields.new_password')}}</label>
                <input type="password" class="form-control py-2" name="new_password"/>
                <small class="form-text text-muted">{{__('user/setting/setting.extra.Leave it blank if not changed')}}</small>

                @error('new_password')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-outline form-dark mb-2">
                <label>{{__('user/setting/setting.fields.password_confirmation')}}</label>
                <input type="password" class="form-control py-2" name="password_confirmation" />
                @error('password_confirmation')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">{{__('user/setting/setting.buttons.edit')}}</button>
        </form>
    </div>
</div>
@endsection

