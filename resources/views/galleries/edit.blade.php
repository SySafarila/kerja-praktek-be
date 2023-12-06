@extends('layouts.adminlte', [
    'title' => 'Admin Dashboard | Galleries - Edit',
])

@section('head')
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp">
    {{-- Select2 --}}
    <link rel="stylesheet" href="{{ asset('adminlte-3.2.0/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte-3.2.0/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 d-flex align-items-center">
                    <h1 class="m-0">Edit a Galleries</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item text-capitalize"><a
                                href="{{ route('admin.galleries.index') }}">Galleries</a>
                        </li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="content pb-3">
        <div class="container-fluid">
            <div class="card m-0">
                <form action="{{ route('admin.galleries.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Add the method field for the update request -->

                    <div class="card-body">
                        <div class="form-group">
                            <label for="title" class="text-capitalize">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $gallery->title) }}" placeholder="Enter title" required>
                            @error('title')
                                <div class="text-sm text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description" class="text-capitalize">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="6" placeholder="Enter description">{{ old('description', $gallery->description) }}</textarea>
                            @error('description')
                                <div class="text-sm text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="thumbnail" class="text-capitalize">Thumbnail Image</label>
                            <input type="file" class="form-control-file" id="thumbnail" name="thumbnail" accept="image/*" onchange="previewThumbnail(this)">
                            @error('thumbnail')
                                <div class="text-sm text-danger">{{ $message }}</div>
                            @enderror
                            <img id="thumbnailPreview" src="{{ asset('storage/galleryThumbnails/' . $gallery->thumbnail) }}" alt="Thumbnail" class="mt-2" style="width: full; height: 100px; object-fit: cover;">
                            <small id="currentThumbnailText">Current Thumbnail</small>
                        </div>


                        <div class="form-group">
                            <label for="images" class="text-capitalize">Gallery Images (Up to 3)</label>
                            <input type="file" class="form-control-file" id="images" name="images[]" accept="image/*" multiple onchange="previewGalleryImages(this)">
                            @error('images')
                                <div class="text-sm text-danger">{{ $message }}</div>
                            @enderror
                            <div id="galleryImagesPreviewContainer" class="mt-2">
                                @if ($gallery->images->count() > 0)
                                    @foreach ($gallery->images as $image)
                                        <img id="galleryImagesPreview" src="{{ asset('storage/galleryImages/' . $image->images) }}" alt="Gallery Image" style="width: full; height: 100px; object-fit: cover;">
                                    @endforeach
                                @endif
                            </div>
                            <small id="currentGalleryImagesText">Current Gallery Images</small>
                        </div>


                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    function previewThumbnail(input) {
        var file = input.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#thumbnailPreview').attr('src', e.target.result);
                $('#currentThumbnailText').hide();
            };
            reader.readAsDataURL(file);
        } else {
            // If no file is selected, show the current image and text
            $('#thumbnailPreview').attr('src', '{{ asset('storage/galleryThumbnails/' . $gallery->thumbnail) }}');
            $('#currentThumbnailText').show();
        }
    }
</script>
<script>
    function previewGalleryImages(input) {
        var files = input.files;
        var galleryImagesPreviewContainer = $('#galleryImagesPreviewContainer');
        galleryImagesPreviewContainer.empty(); // Clear existing previews

        for (var i = 0; i < files.length; i++) {
            var reader = new FileReader();
            reader.onload = function(e) {
                galleryImagesPreviewContainer.append('<img src="' + e.target.result + '" alt="Gallery Image" class="mt-2" style="width: full; height: 100px; object-fit: cover; padding: 2px;">');
            };
            reader.readAsDataURL(files[i]);
        }
        $('#currentGalleryImagesText').hide();
    }
</script>


{{-- Select2 --}}
    <script src="{{ asset('adminlte-3.2.0/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $('.select2').select2({
            theme: 'bootstrap4',
            closeOnSelect: true,
            // minimumResultsForSearch: -1
        })
    </script>
    {{-- jQuery --}}
    <script src="{{ asset('adminlte-3.2.0/plugins/jquery/jquery.min.js') }}"></script>
    {{-- Bootstrap 4 --}}
    <script src="{{ asset('adminlte-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
@endsection
