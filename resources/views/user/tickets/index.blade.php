@extends('layouts.user')
@section('title', __('user/support/user_ticket.pages.index'))
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
            {{__('user/support/user_ticket.pages.index')}}
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th> {{__('user/support/user_ticket.fields.name')}}</th>
                        <th>{{__('user/support/user_ticket.fields.subject')}}</th>
                        <th>{{__('user/support/user_ticket.fields.ticket_category_id')}}</th>
                        <th>{{__('user/support/user_ticket.fields.message')}}</th>
                        <th>{{__('user/support/user_ticket.fields.status')}}</th>
                        <th style="width:100px">{{__('user/support/user_ticket.extra.actions')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tickets as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->subject }}</td>
                            <td><span class="badge bg-success">
                                    @if (isset($item->category->name))
                                        {{ $item->category->name }}
                                    @else
                                       {{__('user/support/user_ticket.extra.notfound')}}
                                    @endif
                                </span>
                            </td>
                            <td>{{ \Str::limit($item->message, 50, '...') }}</td>

                            @if ($item->status)
                                <td><span class="badge bg-success">
                                    {{__('user/support/user_ticket.extra.open')}}
                                    </span>
                                </td>
                            @else
                                <td><span class="badge bg-danger">
                                    {{__('user/support/user_ticket.extra.close')}}
                                    </span>
                                </td>
                            @endif

                            <td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('user.ticket.show', $item->id) }}" class="mx-1 btn btn-success">{{__('user/support/user_ticket.extra.see_message')}}
                                        </i></a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-danger text-center">لا توجد تذاكر بعد</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
