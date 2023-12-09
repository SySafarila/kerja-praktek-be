@extends('layouts.adminlte', [
    'title' => 'Admin Dashboard | Teachers'
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
                    <h1 class="m-0">Edit teacher</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item text-capitalize"><a
                                href="{{ route('admin.teachers.index') }}">teachers</a>
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

                <form action="{{ route('admin.teachers.update', $teacher->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name" class="text-capitalize">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter name" value="{{ old('name', $teacher->name) }}" required>
                            @error('name')
                                <div class="text-sm text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image" class="text-capitalize">Image</label>
                            <div class="wrapper text-left mb-2">
                                <img id="imagePreview" src="{{ asset('storage/teacherImages/' . $teacher->image) }}"
                                    style="width: 128px; height: 128px; object-fit: cover;">
                                <span id="currentImageText" class="text-sm"><- Current Image</span>
                            </div>
                            <input type="file" class="form-control-file" id="image" name="image" accept="image/*"
                                onchange="previewImage(this)">
                            @error('image')
                                <div class="text-sm text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="subjects" class="text-capitalize">Subjects</label>
                            <select class="form-control select2" id="subjects" name="subject_id[]" multiple>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}"
                                        {{ in_array($subject->id, $teacher->subjects->pluck('id')->toArray()) ? 'selected' : '' }}>
                                        {{ $subject->name }} - Kelas {{ $subject->grade }}
                                    </option>
                                @endforeach
                            </select>
                            @error('subject_id')
                                <div class="text-sm text-danger">{{ $message }}</div>
                            @enderror
                        </div>



                        <div class="form-group">
                            <label for="nuptk" class="text-capitalize">NUPTK</label>
                            <input type="text" class="form-control" id="nuptk" name="nuptk"
                                placeholder="Enter nuptk" value="{{ old('nuptk', $teacher->nuptk) }}">
                            @error('nuptk')
                                <div class="text-sm text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nip" class="text-capitalize">NIP</label>
                            <input type="text" class="form-control" id="nip" name="nip" placeholder="Enter NIP"
                                value="{{ old('nip', $teacher->nip) }}">
                            @error('nip')
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
    {{-- Select2 --}}
    <script src="{{ asset('adminlte-3.2.0/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $('.select2').select2({
            theme: 'bootstrap4',
            closeOnSelect: true,
            // minimumResultsForSearch: -1
        })
    </script>
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
                $('#imagePreview').attr('src', '{{ asset('storage/teacherImages/' . $teacher->image) }}');
                $('#currentImageText').show();
            }
        }
    </script>

    {{-- jQuery --}}
    <script src="{{ asset('adminlte-3.2.0/plugins/jquery/jquery.min.js') }}"></script>
    {{-- Bootstrap 4 --}}
    <script src="{{ asset('adminlte-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
@endsection
