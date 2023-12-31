@extends('layouts.user')
@section('title', __('user/support/user_ticket.pages.show'))
@push('css')
    <link rel="stylesheet" href="{{ asset('css/support/tickets.css') }}">
@endpush

@section('content')
    <div class="clearfix"></div>
    @if (session()->has('success'))
        <p class="alert alert-success" role="alert">{{ session('success') }}</p>
    @endif
    @if (session()->has('error'))
        <p class="alert alert-danger">{{ session('error') }}</p>
    @endif

    <div class="card shadow-sm">

        <div class="card shadow-sm">
            <div class="card-header bg-dark">
                {{__('user/support/user_ticket.pages.show')}}
            </div>

            <div class="card-body">
                <div class="ticket-container">
                    <div class="container">
                        <div class="row">
                            <div class="col-2 text-center">
                                <div class="user-avatar">
                                    <img src="{{ $ticket->user->avatar_image }}" alt="User avatar">
                                    {{ $ticket->user->name }}
                                    @if ($ticket->is_admin == 1)
                                        <div class="admin-tag">Admin</div>
                                    @else
                                        <div class="admin-tag" style="background-color:#2ecc71">User</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-10">
                                <div class="message @if ($ticket->is_admin == 1) admin-message @endif">
                                    <p>{{ $ticket->message }}</p>
                                </div>
                                <div class="d-flex flex-column mt-3" style="font-size: 10px">
                                    <span class="ml-auto mr-0">{{ $ticket->created_at }}</span>
                                    <span class="ml-auto mr-0">{{ $ticket->created_at->diffForHumans() }}</span>
                                </div>
                            </div>

                        </div>
                    </div>
                    </br>
                    @foreach ($ticket->messages as $message)
                        <div class="container">
                            <div class="row">
                                <div class="col-2 text-center">
                                    <div class="user-avatar">
                                        <img src="{{ $message->user->avatar_image }}"
                                            alt="User avatar">
                                        {{ $message->user->name }}
                                        @if ($message->is_admin)
                                            <div class="admin-tag">Admin</div>
                                        @else
                                            <div class="admin-tag" style="background-color:#2ecc71">User</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-10">
                                    <div class="message @if ($message->is_admin) admin-message @endif">
                                        <p>{{ $message->message }}</p>
                                           
                                    </div>
                                    <div class="d-flex flex-column mt-3" style="font-size: 10px">
                                        <span class="ml-auto mr-0">{{ $message->created_at }}</span>
                                        <span class="ml-auto mr-0">{{ $message->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </br>
                    @endforeach
                    </br>
                    <div class="container">
                        <!-- Messages container -->
                        <div class="messages-container">
                            <!-- Display messages here -->
                        </div>
                        <!-- Form to send messages -->
                        <form method="POST" action="{{ route('admin.tickets.store') }}">
                            @csrf
                            <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                            <div class="form-group">
                                <textarea class="form-control" name="message" placeholder="{{__('user/support/user_ticket.extra.write_message')}}"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">{{__('user/support/user_ticket.buttons.send')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
