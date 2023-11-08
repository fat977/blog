@extends('layouts.admin')

@section('title', __('admin/support/ticket.pages.index') )
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
            {{__('admin/support/ticket.pages.index')}} 
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>{{__('admin/support/ticket.fields.name')}}</th>
                        <th>{{__('admin/support/ticket.fields.subject')}}</th>
                        <th>{{__('admin/support/ticket.fields.ticket_category_id')}}</th>
                        <th>{{__('admin/support/ticket.fields.message')}}</th>
                        <th>{{__('admin/support/ticket.fields.status')}}</th>
                        <th style="width:100px">{{__('admin/support/ticket.extra.actions')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tickets as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->subject }}</td>
                            <td><span
                                    class="badge bg-success">
                                    @if(isset($item->category->name)){{ $item->category->name }} 
                                    @else
                                    {{__('admin/support/ticket.extra.notfound')}} 
                                    @endif
                                </span>
                            </td>
                            <td>{{ \Str::limit($item->message, 50, '...') }}</td>
                            
                            @if ($item->status)
                            <td><span class="badge bg-success">
                                {{__('admin/support/ticket.extra.open')}}
                            </span>
                            </td>
                            @else
                            <td><span class="badge bg-danger">
                                {{__('admin/support/ticket.extra.close')}}
                            </span>
                        </td>
                            @endif

                            <td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{route('admin.tickets.show',$item->id)}}"
                                        class="mx-1 btn btn-success">{{__('admin/support/ticket.extra.see_message')}} </i></a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-danger text-center">{{__('admin/support/ticket.extra.no_tickets')}}   </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
@endsection
