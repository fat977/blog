@extends('layouts.admin')
@section('content')
@section('title')
    {{ __('admin/CMS/faq/faq.pages.index') }}
@endsection
<a href={{ route('admin.faqs.create') }} class="btn btn-info float-left my-2"> <i class="fa-solid fa-plus"></i>
    {{ __('admin/CMS/faq/faq.buttons.create') }}</a>
<div class="clearfix"></div>
@if (session()->has('success'))
    <p class="alert alert-success" role="alert">{{ session('success') }}</p>
@endif
@if (session()->has('error'))
    <p class="alert alert-danger">{{ session('error') }}</p>
@endif
<div class="card shadow-sm">
    <div class="card-header bg-dark">
        {{ __('admin/CMS/faq/faq.pages.index') }}
    </div>
    <div class="card-body table-responsive">
        <table class="table table-striped text-center" id="faqs">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>{{ __('admin/CMS/faq/faq.fields.title') }}</th>
                    <th>{{ __('admin/CMS/faq/faq.fields.answer') }}</th>
                    <th>{{ __('admin/CMS/faq/faq.fields.categories') }}</th>
                    <th>{{ __('admin/CMS/faq/faq.extra.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($faqs as $faq)
                    <tr>
                        <td>{{ $faq->id }}</td>
                        <td>{{ $faq->title }}</td>
                        <td>{!! $faq->answer !!} </td>
                        <td>
                            @foreach ($faq->categories as $category)
                                <span class="span-tag bg-warning rounded px-1 w-50">{{ $category->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('admin.faqs.edit', $faq->id) }}" class="mx-1 btn btn-success"><i
                                    class="fas fa-edit"></i></a>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                data-target="#confirm-delete-{{ $faq->id }}">
                                <i class="fas fa-trash p-2"></i>
                            </button>
                            <div class="modal fade" id="confirm-delete-{{ $faq->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <p class="modal-title">{{ __('admin/CMS/faq/faq.extra.confirm_delete') }}</p>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-left">
                                            <p>{{ __('admin/CMS/faq/faq.extra.Are you sure you want delete this item') }}</p>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default btn-md"
                                                data-dismiss="modal">{{ __('admin/CMS/faq/faq.extra.close') }}</button>
                                            <form action="{{ route('admin.faqs.destroy', $faq->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-dark btn-md">{{ __('admin/CMS/faq/faq.extra.yes') }}</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

</div>
@endsection
