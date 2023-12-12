@extends('layouts.adminlte')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <x-adminlte.session-notifications />
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">PPDB Settings</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">PPDB Settings</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card m-0">
            <div class="card-body">
                <form action="{{ route('admin.ppdb-settings.update', 'update') }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="ppdb_price" class="text-capitalize">Biaya PPDB</label>
                        <input type="number" class="form-control" id="ppdb_price" name="ppdb_price" value="{{ $ppdb_price->value }}" required>
                        @error('ppdb_price')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="accept_students" class="text-capitalize d-block">Penerimaan PPDB</label>
                        <select name="accept_students" id="accept_students" class="custom-select" required>
                            <option value="true" {{ $ppdb_accept_student->value == 'true' ? 'selected': '' }}>YES</option>
                            <option value="false" {{ $ppdb_accept_student->value == 'false' ? 'selected': '' }}>NO</option>
                        </select>
                        @error('accept_students')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
