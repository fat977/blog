@extends('layouts.admin')
@section('title')
    {{ __('admin/file_upload/file_upload.pages.create') }}
@endsection
@push('css')
    <!-- dropzonejs -->
    <link rel="stylesheet" href="{{ asset('plugins/dropzone/min/dropzone.min.css') }}"n>
@endpush
@section('content')
    <div class="container-fluid pt-3">

        @include('partials.session')
        @if (session()->has('file-type-error'))
            <div class='alert alert-danger'>
                {{ session('file-type-error') }}
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-header bg-dark">
                {{ __('admin/file_upload/file_upload.pages.create') }}
            </div>
            <div class="card-body">
                <form action="{{ route('admin.uploads.store') }}" method="POST" class="dropzone" id="my-dropzone"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card card-default">

                        <div class="card-body">
                            <div id="actions" class="row">
                                <div class="col-lg-6">
                                    <div class="btn-group w-100">
                                        <span class="btn btn-success col fileinput-button">
                                            <i class="fas fa-plus"></i>
                                            <span>{{ __('admin/file_upload/file_upload.buttons.create') }}</span>
                                        </span>
                                        <button type="submit" class="btn btn-primary col start">
                                            <i class="fas fa-upload"></i>
                                            <span>{{ __('admin/file_upload/file_upload.buttons.upload') }}</span>
                                        </button>
                                        <button type="reset" class="btn btn-warning col cancel">
                                            <i class="fas fa-times-circle"></i>
                                            <span>{{ __('admin/file_upload/file_upload.buttons.stop') }}</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-lg-6 d-flex align-items-center">
                                    <div class="fileupload-process w-100">
                                        <div id="total-progress" class="progress progress-striped active" role="progressbar"
                                            aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                            <div class="progress-bar progress-bar-success" style="width:0%;"
                                                data-dz-uploadprogress></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table table-striped files" id="previews">
                                <div id="template" class="row mt-2">
                                    <div class="col-auto">
                                        <span class="preview"><img src="data:," alt="" data-dz-thumbnail /></span>
                                    </div>
                                    <div class="col d-flex align-items-center">
                                        <p class="mb-0">
                                            <span class="lead" data-dz-name></span>
                                            (<span data-dz-size></span>)
                                        </p>
                                        <strong class="error text-danger" data-dz-errormessage></strong>
                                    </div>
                                    <div class="col-4 d-flex align-items-center">
                                        <div class="progress progress-striped active w-100" role="progressbar"
                                            aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                            <div class="progress-bar progress-bar-success" style="width:0%;"
                                                data-dz-uploadprogress></div>
                                        </div>
                                    </div>
                                    <div class="col-auto d-flex align-items-center">
                                        <div class="btn-group">
                                            <button class="btn btn-primary start">
                                                <i class="fas fa-upload"></i>
                                                <span>{{ __('admin/file_upload/file_upload.buttons.start') }}</span>
                                            </button>
                                            <button data-dz-remove class="btn btn-warning cancel">
                                                <i class="fas fa-times-circle"></i>
                                                <span>{{ __('admin/file_upload/file_upload.buttons.cancel') }}</span>
                                            </button>
                                            <button data-dz-remove class="btn btn-danger delete">
                                                <i class="fas fa-trash"></i>
                                                <span>{{ __('admin/file_upload/file_upload.buttons.delete') }}</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </form>

            </div>
        </div>

    </div>
@endsection

@push('js')
    <!-- dropzonejs -->
    <script src="{{ asset('plugins/dropzone/min/dropzone.min.js') }}"></script>

    <script>
        // DropzoneJS Demo Code Start
        Dropzone.autoDiscover = false

        // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
        var previewNode = document.querySelector("#template")
        previewNode.id = ""
        var previewTemplate = previewNode.parentNode.innerHTML
        previewNode.parentNode.removeChild(previewNode)

        var myDropzone = new Dropzone("#my-dropzone", { // Make the whole body a dropzone
            url: "{{ route('admin.uploads.store') }}", // Set the url
            // acceptedFiles: ".png,.jpg,.jpeg,.gif,.bmp,.pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx",
            thumbnailWidth: 80,
            thumbnailHeight: 80,
            parallelUploads: 20,
            previewTemplate: previewTemplate,
            autoQueue: false, // Make sure the files aren't queued until manually added
            previewsContainer: "#previews", // Define the container to display the previews
            clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
        })

        myDropzone.on("addedfile", function(file) {
            // Hookup the start button
            var extension = file.name.split('.').pop();
            if (extension === 'html' || extension === 'css' || extension === 'js' || extension === 'php') {
                // حذف الملف من قائمة الرفع وإظهار رسالة خطأ
                // myDropzone.removeFile(file);
                // alert('غير مسموح بادخال هذا النوع من الملفات');
            }
            file.previewElement.querySelector(".start").onclick = function() {
                myDropzone.enqueueFile(file)
            }
        })

        // Update the total progress bar
        myDropzone.on("totaluploadprogress", function(progress) {
            document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
        })

        myDropzone.on("sending", function(file) {
            // Show the total progress bar when upload starts
            document.querySelector("#total-progress").style.opacity = "1"
            // And disable the start button
            file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
        })

        // Hide the total progress bar when nothing's uploading anymore
        myDropzone.on("queuecomplete", function(progress) {
            document.querySelector("#total-progress").style.opacity = "0"
        })

        // Setup the buttons for all transfers
        // The "add files" button doesn't need to be setup because the config
        // `clickable` has already been specified.
        document.querySelector("#actions .start").onclick = function() {
            myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
        }
        document.querySelector("#actions .cancel").onclick = function() {
            myDropzone.removeAllFiles(true)
        }

        myDropzone.on("success", function(file, response) {
            // Redirect to another page using JavaScript or the window.location.href property
            window.location.href = "{{ route('admin.uploads.index') }}";
        })

        myDropzone.on("error", function(file, response) {
            console.log(response.errors);
            // Parse the response JSON to get the validation errors
            var errors = response.errors;

            // Display the validation errors in the error container
            var errorContainer = document.querySelector("#dropzone-errors");
            errorContainer.innerHTML = "";

            for (var field in errors) {
                console.log(field)
                {{ session()->put('file-type-error', __('admin/file_upload/file_upload.extra.This type of file is not allowed')) }}
                var errorMessage = errors[field].join("<br>");
                errorContainer.innerHTML += "<div class='alert alert-danger'>" + errorMessage + "</div>";

            }

            // Remove the file from the upload queue
            myDropzone.removeFile(file);
        });
        // DropzoneJS Demo Code End
    </script>
@endpush
