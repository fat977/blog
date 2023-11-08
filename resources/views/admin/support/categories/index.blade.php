@extends('layouts.admin')

@section('title', __('admin/support/category/ticket_category.pages.index') )
@section('content')
    <a href={{ route('admin.TicketsCategory.create') }} class="btn btn-info float-right mb-2"> <i class="fa-solid fa-plus"></i>
        {{ __('admin/support/category/ticket_category.buttons.create') }}</a>
    <div class="clearfix"></div>
    @if (session()->has('success'))
        <p class="alert alert-success" role="alert">{{ session('success') }}</p>
    @endif
    @if (session()->has('error'))
        <p class="alert alert-danger">{{ session('error') }}</p>
    @endif
    <div class="card shadow-sm">
        <div class="card-header bg-dark">
            {{ __('admin/support/category/ticket_category.pages.index') }}
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>{{ __('admin/support/category/ticket_category.fields.name') }}</th>
                        <th style="width:100px">{{ __('admin/support/category/ticket_category.extra.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.TicketsCategory.edit', $item->id) }}"
                                        class="mx-1 btn btn-success"><i class="fas fa-edit"></i></a>
                                    <button type="button" class="mx-1 btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#confirm-delete-{{ $item->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <div class="modal fade" id="confirm-delete-{{ $item->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <p class="modal-title">{{ __('admin/support/category/ticket_category.extra.confirm_delete') }}</p>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-left">
                                                    <p>{{ __('admin/support/category/ticket_category.extra.Are you sure you want delete this item') }}</p>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default btn-md"
                                                        data-dismiss="modal">{{ __('admin/support/category/ticket_category.extra.close') }}</button>
                                                    <form action="{{ route('admin.TicketsCategory.destroy', $item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-dark btn-md">{{ __('admin/support/category/ticket_category.extra.yes') }}</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-danger text-center">لا توجدانواع بعد</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix">
            {!! $categories->links() !!}
        </div>
    </div>
@endsection
