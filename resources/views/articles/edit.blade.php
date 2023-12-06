@extends('layouts.adminlte', [
    'title' => 'Admin Dashboard | Articles - Edit',
])

@section('head')
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp">
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 d-flex align-items-center">
                    <h1 class="m-0">Edit an Articles</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item text-capitalize"><a
                                href="{{ route('admin.articles.index') }}">articles</a>
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
                <form action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <label for="title" class="text-capitalize">title</label>
                            <input type="text" class="form-control" id="title" title="title" name="title"
                                placeholder="Enter title" value="{{$article->title}}" required>
                            @error('title')
                                <div class="text-sm text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image" class="text-capitalize">image</label>
                            <div class="wrapper text-left mb-2">
                                <img id="imagePreview" src="{{ asset('storage/articleImages/' . $article->image) }}"
                                    style="height: 256px; object-fit: cover;">
                                <span id="currentImageText" class="text-sm wrapper">Current Image</span>
                            </div>
                            <input type="file" class="form-control-file" id="image" name="image" accept="image/*"
                                onchange="previewImage(this)">
                            @error('image')
                                <div class="text-sm text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="story" class="text-capitalize">story</label>
                            <textarea type="text" class="form-control" id="story" story="story" name="story"
                                placeholder="Write down the story" rows="12" required>{{$article->story}}</textarea>
                            @error('story')
                                <div class="text-sm text-danger">{{ $message }}</div>
                            @enderror
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
    function previewImage(input) {
        var file = input.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').attr('src', e.target.result);
                $('#currentImageText').hide();
            };
            reader.readAsDataURL(file);
        } else {
            // If no file is selected, show the current image and text
            $('#imagePreview').attr('src', '{{ asset('storage/articleImages/' . $article->image) }}');
            $('#currentImageText').show();
        }
    }
</script>
    {{-- jQuery --}}
    <script src="{{ asset('adminlte-3.2.0/plugins/jquery/jquery.min.js') }}"></script>
    {{-- Bootstrap 4 --}}
    <script src="{{ asset('adminlte-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
@endsection
