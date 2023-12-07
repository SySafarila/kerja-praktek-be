@extends('layouts.adminlte', [
    'title' => 'Admin Dashboard | Testimonials - Edit',
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
                    <h1 class="m-0">Edit a Testimonial</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item text-capitalize"><a
                                href="{{ route('admin.testimonials.index') }}">testimonials</a>
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
                <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH') {{-- Use the PUT method for updates --}}
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name" class="text-capitalize">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $testimonial->name }}" required>
                            @error('name')
                                <div class="text-sm text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status" class="text-capitalize">Status or Occupation</label>
                            <input type="text" class="form-control" id="status" name="status"
                                value="{{ $testimonial->status }}">
                            @error('status')
                                <div class="text-sm text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="feedback" class="text-capitalize">Feedback</label>
                            <textarea class="form-control" id="feedback" name="feedback" rows="4" required>{{ $testimonial->feedback }}</textarea>
                            @error('feedback')
                                <div class="text-sm text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image" class="text-capitalize">Testimonial Image</label>
                            <div class="wrapper text-left mb-2">
                                <img id="testimonialImagePreview"
                                    src="{{ asset('storage/testimonialImages/' . $testimonial->image) }}"
                                    alt="Testimonial Image" class="mt-2"
                                    style="width: 128px; height: 128px; object-fit: cover;">
                                <small id="currentTestimonialImageText"><- Current Testimonial Image</small>
                            </div>
                            <input type="file" class="form-control-file" id="image" name="image"
                                accept="image/*" onchange="previewTestimonialImage(this)">
                            @error('image')
                                <div class="text-sm text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function previewTestimonialImage(input) {
            var file = input.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#testimonialImagePreview').attr('src', e.target.result);
                    $('#currentTestimonialImageText').hide();
                };
                reader.readAsDataURL(file);
            } else {
                // If no file is selected, show the current image and text
                $('#testimonialImagePreview').attr('src',
                    '{{ asset('storage/testimonialImages/' . $testimonial->image) }}');
                $('#currentTestimonialImageText').show();
            }
        }
    </script>
    {{-- jQuery --}}
    <script src="{{ asset('adminlte-3.2.0/plugins/jquery/jquery.min.js') }}"></script>
    {{-- Bootstrap 4 --}}
    <script src="{{ asset('adminlte-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
@endsection
