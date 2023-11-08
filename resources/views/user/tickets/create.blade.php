@extends('layouts.user')
@section('title', __('user/support/user_ticket.pages.create'))
@section('content')
    <div class="clearfix"></div>
    @if (session()->has('success'))
        <p class="alert alert-success" role="alert">{{ session('success') }}</p>
    @endif
    @if (session()->has('error'))
        <p class="alert alert-danger">{{ session('error') }}</p>
    @endif
    <div class="card shadow-sm">
        <div class="card-header bg-dark">
            {{__('user/support/user_ticket.extra.header')}}
        </div>
        <div class="card-body">
            <form id="quickForm" method="POST" action={{ route('user.ticket.store') }}>
                @csrf
                <div class="form-group mt-4">
                    <label for="message">{{__('user/support/user_ticket.fields.subject')}}</label>
                    <input type="text" name="subject" class="form-control" value="{{ old('subject') }}"
                        placeholder="{{__('user/support/user_ticket.extra.subject')}}">
                    @error('subject')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-row mt-4">
                    <div class="form-group col-md-12">
                        <label for="type">{{__('user/support/user_ticket.fields.ticket_category_id')}}</label>
                        <select class="form-control" name="ticket_category_id" id="type">
                            <option value="">{{__('user/support/user_ticket.extra.ticket_category_id')}} </option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('ticket_category_id') == $category->id)>{{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('ticket_category_id')
                            <p class="text-danger small">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
                <div class="form-group mt-4">
                    <label for="message">{{__('user/support/user_ticket.fields.message')}}</label>
                    <textarea class="form-control" id="text" rows="3" name="message" placeholder="{{__('user/support/user_ticket.extra.message')}}">{{ old('message') }}</textarea>
                    @error('message')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>
                {{-- <div class="form-group">
                    <label for="text">النص</label>
                    <textarea id="summernote" name="text">
                        اكتب النص هنا
                    </textarea>
                </div> --}}
                <button type="submit" class="btn btn-dark">{{__('user/support/user_ticket.buttons.create')}}</button>
            </form>
        </div>
    </div>
@endsection
