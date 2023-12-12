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
                        <label for="ppdb_price" class="text-capitalize">PPDB Price</label>
                        <input type="number" class="form-control" id="ppdb_price" name="ppdb_price" value="{{ $ppdb_price->value }}">
                        @error('ppdb_price')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    {{-- <div class="form-group">
                        <label for="" class="text-capitalize d-block">Environment</label>
                        <div class="align-items-center d-flex" style="gap: 14px;">
                            <div class="align-items-center d-flex" style="gap: 5px;">
                                <input type="radio" name="is_prod" id="is_prod" value="1" {{ $isProd->isProd == true ?
                                'checked' : '' }}>
                                <label class="font-weight-normal m-0" for="is_prod">Production</label>
                            </div>
                            <div class="align-items-center d-flex" style="gap: 5px;">
                                <input type="radio" name="is_prod" id="is_dev" value="0" {{ $isProd->isProd == false ?
                                'checked' : '' }}>
                                <label class="font-weight-normal m-0" for="is_dev">Development</label>
                            </div>
                        </div>
                    </div> --}}
                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
