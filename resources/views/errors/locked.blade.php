@extends('layouts.guest')
@section('content')
@section('title')
    {{__('guest/error.pages.locked')}}
@endsection
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-lock fa-5x mb-4"></i>
                    <h5 class="card-title">{{__('guest/error.pages.locked')}}</h5>
                    {!! $settingService->get('reason_locked') !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
