@extends('layouts.adminlte', [
    'title' => 'Admin Dashboard | Subjects'
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
                    <h1 class="m-0">Create a Subject</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item text-capitalize"><a href="{{ route('admin.subjects.index') }}">subjects</a>
                        </li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content pb-3">
        <div class="container-fluid">
            <div class="card m-0">
                <form action="{{ route('admin.subjects.store') }}" method="POST" >
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="text-capitalize">Subject</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter name of the subject" required>
                            @error('name')
                                <div class="text-sm text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="grade" class="text-capitalize">Grade</label>
                            <select class="form-control" id="grade" name="grade" required>
                                <option value="10">Grade 10</option>
                                <option value="11">Grade 11</option>
                                <option value="12">Grade 12</option>
                            </select>
                            @error('grade')
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
