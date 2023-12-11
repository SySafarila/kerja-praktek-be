@extends('layouts.adminlte')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <x-adminlte.session-notifications />
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Midtrans Payment Gateway Settings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Midtrans Settings</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="card m-0">
                <div class="card-body">
                    <form action="{{ route('admin.midtrans-settings.update', 'update') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="server_key_dev" class="text-capitalize">Server Key Dev</label>
                            <input type="text" class="form-control" id="server_key_dev" name="server_key_dev"
                                value="{{ $serverKeyDev->key }}">
                        </div>
                        <div class="form-group">
                            <label for="server_key_prod" class="text-capitalize">Server Key Prod</label>
                            <input type="text" class="form-control" id="server_key_prod" name="server_key_prod"
                                value="{{ $serverKeyProd->key }}">
                        </div>
                        <div class="form-group">
                            <label for="client_key_dev" class="text-capitalize">Client Key Dev</label>
                            <input type="text" class="form-control" id="client_key_dev" name="client_key_dev"
                                value="{{ $clientKeyDev->key }}">
                        </div>
                        <div class="form-group">
                            <label for="client_key_prod" class="text-capitalize">Client Key Prod</label>
                            <input type="text" class="form-control" id="client_key_prod" name="client_key_prod"
                                value="{{ $clientKeyProd->key }}">
                        </div>
                        <div class="form-group">
                            <label for="" class="text-capitalize d-block">Environment</label>
                            <div class="align-items-center d-flex" style="gap: 14px;">
                                <div class="align-items-center d-flex" style="gap: 5px;">
                                    <input type="radio" name="is_prod" id="is_prod" value="1"
                                        {{ $isProd->isProd == true ? 'checked' : '' }}>
                                    <label class="font-weight-normal m-0" for="is_prod">Production</label>
                                </div>
                                <div class="align-items-center d-flex" style="gap: 5px;">
                                    <input type="radio" name="is_prod" id="is_dev" value="0"
                                        {{ $isProd->isProd == false ? 'checked' : '' }}>
                                    <label class="font-weight-normal m-0" for="is_dev">Development</label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
