@php
    function exchange($payment_method) {
        switch ($payment_method) {
            case 'va_bca':
                return 'BCA Virtual Account';
                break;

            case 'va_bni':
                return 'BNI Virtual Account';
                break;

            case 'va_bri':
                return 'BRI Virtual Account';
                break;

            case 'va_permata':
                return 'Permata Virtual Account';
                break;

            case 'va_cimb':
                return 'CIMB Virtual Account';
                break;

            case 'gopay':
                return 'GoPay';
                break;

            case 'shopeepay':
                return 'ShopeePay';
                break;

            case 'qris':
                return 'QRIS';
                break;

            case 'offline':
                return 'Bayar di sekolah';
                break;

            default:
                return '-';
                break;
        }
    }
@endphp
@extends('layouts.adminlte')

@section('head')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp">

    {{-- Select2 --}}
    <link rel="stylesheet" href="{{ asset('adminlte-3.2.0/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte-3.2.0/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

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
                    <div class="form-group">
                        <label for="payment_methods" class="text-capitalize">Metode Pembayaran</label>
                        <select class="select2 form-control" multiple="multiple" name="payment_methods[]"
                            data-placeholder="Select payments" style="width: 100%;">
                            @foreach (explode(',', $payment_method_list) as $payment_method)
                                <option value="{{ $payment_method }}" {{ in_array($payment_method, explode(',', $payment_methods->value)) ? 'selected' : '' }}>{{ exchange($payment_method) }}</option>
                            @endforeach
                        </select>
                        @error('payment_methods')
                        <div class="text-sm text-danger">{{ $message ?? 'Something error' }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                </form>
                {{-- @foreach (explode(',', $payment_method_list) as $payment_method)
                    <p>{{ $payment_method }}</p>
                @endforeach
                <p>=========================</p>
                @foreach (explode(',', $payment_methods) as $payment_method)
                    <p>{{ $payment_method }}</p>
                @endforeach --}}
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
