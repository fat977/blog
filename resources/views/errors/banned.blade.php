@extends('layouts.user')
@section('content')
@section('title')
{{__('guest/error.pages.banned')}}
@endsection
<div>

    @if (Auth::user()->is_banned && Auth::user()->banned_until == !null)
        <div class="alert alert-danger">{{__('guest/error.extra.banned_until')}} {{ Auth::user()->banned_until }} </div>
    @else
        <div .........>{{__('guest/error.pages.banned_forever')}}</div>
    @endif
</div>

@endsection
