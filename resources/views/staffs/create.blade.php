@extends('layouts.adminlte', [
    'title' => 'Admin Dashboard | Staffs'
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
                    <h1 class="m-0">Create Staff</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item text-capitalize"><a href="{{ route('admin.staffs.index') }}">staffs</a>
                        </li>
                        <li class="breadcrumb-item active">Create</li>
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
                <form action="{{ route('admin.staffs.store') }}" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="text-capitalize">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter name" required>
                            @error('name')
                                <div class="text-sm text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image" class="text-capitalize">Image</label>
                            <input type="file" class="form-control-file" id="image" name="image" accept="image/*"
                                required>
                            @error('image')
                                <div class="text-sm text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="position" class="text-capitalize">Position</label>
                            <input type="text" class="form-control" id="position" name="position"
                                placeholder="Enter position">
                            @error('position')
                                <div class="text-sm text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nuptk" class="text-capitalize">NUPTK</label>
                            <input type="text" class="form-control" id="nuptk" name="nuptk"
                                placeholder="Enter nuptk">
                            @error('nuptk')
                                <div class="text-sm text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nip" class="text-capitalize">NIP</label>
                            <input type="text" class="form-control" id="nip" name="nip"
                                placeholder="Enter NIP">
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
    {{-- jQuery --}}
    <script src="{{ asset('adminlte-3.2.0/plugins/jquery/jquery.min.js') }}"></script>
    {{-- Bootstrap 4 --}}
    <script src="{{ asset('adminlte-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
@endsection
