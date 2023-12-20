@extends('layouts.adminlte', [
    'title' => 'Admin Dashboard | Peminjaman Buku',
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
                    <h1 class="m-0">Detail Peminjaman Buku</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item text-capitalize"><a
                                href="{{ route('admin.elibraryadminpeminjaman.index') }}">Peminjaman</a>
                        </li>
                        <li class="breadcrumb-item active">Show</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content pb-3">
        <div class="container-fluid">
            <div class="card m-0">
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama" class="text-capitalize">Peminjam</label>
                        <input type="text" class="form-control" id="nama" name="nama"
                            value="{{ $peminjaman->nama }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="jenis" class="text-capitalize">Jenis Buku</label>
                        <input type="text" class="form-control" id="jenis" name="jenis"
                            value="{{ $peminjaman->jenis }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="book_id" class="text-capitalize">Nama Buku</label>
                        <input type="text" class="form-control" id="book_id" name="book_id"
                            value="{{ $peminjaman->buku->nama_buku }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="jumlah" class="text-capitalize">Jumlah</label>
                        <input type="text" class="form-control" id="jumlah" name="jumlah"
                            value="{{ $peminjaman->jumlah }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_peminjaman" class="text-capitalize">Tanggal Peminjaman</label>
                        <input type="text" class="form-control" id="tanggal_peminjaman" name="tanggal_peminjaman"
                            value="{{ $peminjaman->tanggal_peminjaman }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="status" class="text-capitalize">Status Pengembalian</label>
                        <input type="text" class="form-control" id="status" name="status"
                            value="{{ $peminjaman->status }}" readonly>
                    </div>
                </div>

                <div class="card-footer">
                    <a href="{{ route('admin.elibraryadminpeminjaman.index') }}" class="btn btn-primary btn-sm">Back</a>
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
@endsection
