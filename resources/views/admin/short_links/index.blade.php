@extends('layouts.admin')
@section('content')
@section('title', __('admin/shortlink/shortlink.pages.index'))
<a href={{ route('admin.short_links.create') }} class="btn btn-info float-left my-2"> <i class="fa-solid fa-plus"></i>
    {{__('admin/shortlink/shortlink.buttons.create')}} </a>
<div class="clearfix"></div>
@if (session()->has('success'))
    <p class="alert alert-success" role="alert">{{ session('success') }}</p>
@endif
@if (session()->has('error'))
    <p class="alert alert-danger">{{ session('error') }}</p>
@endif
<div class="card shadow-sm">
    <div class="card-header bg-dark">
        {{__('admin/shortlink/shortlink.pages.index')}} 
    </div>
    <div class="card-body table-responsive">
        <table class="table table-striped text-center" id="short_links">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>{{__('admin/shortlink/shortlink.fields.url')}} </th>
                    <th>{{__('admin/shortlink/shortlink.fields.shortlink')}}</th>
                    <th>{{__('admin/shortlink/shortlink.fields.slug')}}</th>
                    <th>{{__('admin/shortlink/shortlink.fields.visits')}}</th>
                    <th>{{__('admin/shortlink/shortlink.extra.actions')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($short_links as $short_link)
                    <tr>
                        <td>{{ $short_link->id }}</td>
                        <td>
                            <a href="{{ route('guest.short_link.show', $short_link) }}"
                                id="myText">{{ $short_link->url }}</a>
                        </td>
                        <td>
                            @if (!empty($short_link->slug))
                                <input type="text" value="{{ route('guest.short_link.show', $short_link->slug) }}"
                                    disabled>
                                <button class="btn"
                                    data-clipboard-text="{{ route('guest.short_link.show', $short_link->slug) }}"
                                    id="copy-button"><i class="fas fa-copy text-secondary"></i></button>
                            @else
                                <input type="text" value="{{ route('guest.short_link.show', $short_link->id) }}" disabled>
                                <button class="btn"
                                    data-clipboard-text="{{ route('guest.short_link.show', $short_link->id) }}"
                                    id="copy-button"><i class="fas fa-copy text-secondary"></i></button>
                            @endif

                        </td>
                        <td>{{ $short_link->slug }} </td>
                        <td>{{ $short_link->statistics()->sum('visits') }} </td>
                        <td>
                            <a href="{{ route('admin.short_links.statistics', $short_link->id) }}"
                                class="mx-1 btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('admin.short_links.edit', $short_link->id) }}"
                                class="mx-1 btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                data-target="#confirm-delete-{{ $short_link->id }}">
                                <i class="fas fa-trash"></i>
                            </button>
                            <div class="modal fade" id="confirm-delete-{{ $short_link->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <p class="modal-title">{{__('admin/shortlink/shortlink.extra.confirm_delete')}}</p>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-left">
                                            <p>{{__('admin/shortlink/shortlink.extra.Are you sure you want delete this item')}}</p>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default btn-md"
                                                data-dismiss="modal">{{__('admin/shortlink/shortlink.extra.close')}}</button>
                                            <form action="{{ route('admin.short_links.destroy', $short_link->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-dark btn-md">{{__('admin/shortlink/shortlink.extra.yes')}}</button>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
<script>
    var clipboard = new ClipboardJS('#copy-button');
</script>
<script>
    navigator.clipboard.readText()
        .then((text) => console.log("Text from clipboard: ", text))
        .catch((error) => console.error("Failed to read text from clipboard: ", error));
</script>
@endsection
