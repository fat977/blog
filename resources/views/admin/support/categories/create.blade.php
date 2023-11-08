@extends('layouts.admin')

@section('title', __('admin/support/category/ticket_category.pages.create'))
{{-- @push('css')
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
@endpush --}}
@section('content')
@if (isset($success))
<h4><?php echo $success; ?></h4>    
@endif
    <a href={{ route('admin.TicketsCategory.index') }} class="btn btn-info float-right mb-2">{{ __('admin/support/category/ticket_category.buttons.all_tickets') }}</a>
    <div class="clearfix"></div>
    @if (session()->has('success'))
        <p class="alert alert-success" role="alert">{{ session('success') }}</p>
    @endif
    @if (session()->has('error'))
        <p class="alert alert-danger">{{ session('error') }}</p>
    @endif
    <div class="card shadow-sm">
        <div class="card-header bg-dark">
            {{ __('admin/support/category/ticket_category.pages.create') }}
        </div>
        <div class="card-body">
            <form id="quickForm" method="POST" action={{ route('admin.TicketsCategory.store') }}>
                @csrf
                <div class="form-group">
                    <label for="name">{{ __('admin/support/category/ticket_category.fields.name') }}</label>
                    <input type="text" name="name" class="form-control"  placeholder="{{ __('admin/support/category/ticket_category.extra.name') }}"
                        value="{{ old('name') }}">
                    @error('name')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div>


                <button type="submit" class="btn btn-dark">{{ __('admin/support/category/ticket_category.buttons.create') }}</button>
            </form>
        </div>
    </div>
@endsection
