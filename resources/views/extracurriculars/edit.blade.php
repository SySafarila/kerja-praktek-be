@extends('layouts.adminlte', [
    'title' => 'Admin Dashboard | Extracurriculars'
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
                    <h1 class="m-0">Edit an Extracurricular</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item text-capitalize"><a
                                href="{{ route('admin.extracurriculars.index') }}">Extracurriculars</a>
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
                <form action="{{ route('admin.extracurriculars.update', $extracurricular->id) }}" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="name" class="text-capitalize">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name', $extracurricular->name) }}" required>
                            @error('name')
                                <div class="text-sm text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image" class="text-capitalize">Image</label>
                            <div class="wrapper text-left mb-2">
                                <img id="imagePreview" src="{{ asset('storage/extracurricularImages/' . $extracurricular->image) }}"
                                    style="width: full; height: 128px; object-fit: cover;">
                                <span id="currentImageText" class="text-sm"><- Current Image</span>
                            </div>
                            <input type="file" class="form-control-file" id="image" name="image" accept="image/*" onchange="previewImage(this)">
                            @error('image')
                                <div class="text-sm text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="schedule" class="text-capitalize">Days of the Week</label>
                            <select class="form-control select2" id="schedule" name="schedule[]" multiple required>
                                <option value="Monday"
                                    {{ in_array('Monday', json_decode($extracurricular->schedule)) ? 'selected' : '' }}>Monday
                                </option>
                                <option value="Tuesday"
                                    {{ in_array('Tuesday', json_decode($extracurricular->schedule)) ? 'selected' : '' }}>Tuesday
                                </option>
                                <option value="Wednesday"
                                    {{ in_array('Wednesday', json_decode($extracurricular->schedule)) ? 'selected' : '' }}>Wednesday
                                </option>
                                <option value="Thursday"
                                    {{ in_array('Thursday', json_decode($extracurricular->schedule)) ? 'selected' : '' }}>Thursday
                                </option>
                                <option value="Friday"
                                    {{ in_array('Friday', json_decode($extracurricular->schedule)) ? 'selected' : '' }}>Friday
                                </option>
                                <option value="Saturday"
                                    {{ in_array('Saturday', json_decode($extracurricular->schedule)) ? 'selected' : '' }}>Saturday
                                </option>
                                <option value="Sunday"
                                    {{ in_array('Sunday', json_decode($extracurricular->schedule)) ? 'selected' : '' }}>Sunday
                                </option>
                            </select>
                            @error('schedule')
                                <div class="text-sm text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="location" class="text-capitalize">Location</label>
                            <input type="text" class="form-control" id="location" name="location"
                                value="{{ old('location', $extracurricular->location) }}">
                            @error('location')
                                <div class="text-sm text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description" class="text-capitalize">Description</label>
                            <textarea class="form-control" id="description" name="description">{{ old('description', $extracurricular->description) }}</textarea>
                            @error('description')
                                <div class="text-sm text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="mentor_id" class="text-capitalize">Mentor</label>
                            <select class="form-control select2" id="mentor_id" name="mentor_id">
                                <option value="" selected disabled>Select a mentor</option>
                                @foreach ($mentors as $mentor)
                                    <option value="{{ $mentor->id }}"
                                        {{ $extracurricular->mentor_id == $mentor->id ? 'selected' : '' }}>
                                        {{ $mentor->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('mentor_id')
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
            $('#imagePreview').attr('src', '{{ asset('storage/extracurricularImages/' . $extracurricular->image) }}');
            $('#currentImageText').show();
        }
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
