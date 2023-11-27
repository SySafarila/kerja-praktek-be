@extends('layouts.adminlte')

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
                    <h1 class="m-0">Edit Account</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('landingpage') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('account.index') }}">Account</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content pb-3">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('account.update', ['account' => $user, 'update' => 'general']) }}"
                        method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="name" class="text-capitalize">name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Syahrul Safarila" value="{{ old('name') ?? $user->name }}" required>
                            @error('name')
                                <div class="text-danger text-sm">{{ $message ?? 'Something error' }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email" class="text-capitalize">email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="mail@mail.com" value="{{ old('email') ?? $user->email }}" required>
                            <small>If you change your email, you have to reverify your new email</small>
                            @error('email')
                                <div class="text-danger text-sm">{{ $message ?? 'Something error' }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                    </form>
                </div>
            </div>
            <div class="card m-0">
                <div class="card-body">
                    <form action="{{ route('account.update', ['account' => $user, 'update' => 'password']) }}"
                        method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="password" class="text-capitalize">password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            @error('password')
                                <div class="text-danger text-sm">{{ $message ?? 'Something error' }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation" class="text-capitalize">password confirmation</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" required>
                            @error('password_confirmation')
                                <div class="text-danger text-sm">{{ $message ?? 'Something error' }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {{-- jQuery --}}
    <script src="{{ asset('adminlte-3.2.0/plugins/jquery/jquery.min.js') }}"></script>
    {{-- Bootstrap 4 --}}
    <script src="{{ asset('adminlte-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    {{-- Select2 --}}
    <script src="{{ asset('adminlte-3.2.0/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $('.select2').select2({
            theme: 'bootstrap4',
            closeOnSelect: false
        })
    </script>
@endsection
