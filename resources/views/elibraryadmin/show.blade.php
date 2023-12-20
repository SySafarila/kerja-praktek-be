@extends('layouts.adminlte', [
    'title' => 'Admin Dashboard | Daftar Buku',
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
                    <h1 class="m-0">Menampilkan Detail Buku</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item text-capitalize"><a
                                href="{{ route('admin.elibrary.index') }}">elibrary</a>
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
                        <label for="nama_buku" class="text-capitalize">Nama Buku</label>
                        <input type="text" class="form-control" id="nama_buku" value="{{ $elibrary->nama_buku }}"
                            placeholder="Masukan Nama Buku" readonly>

                    </div>

                    <div class="form-group">
                        <label for="penulis" class="text-capitalize">Penulis</label>
                        <input type="text" class="form-control" id="penulis" value="{{ $elibrary->penulis }}"
                            placeholder="Masukan Nama Penulis" readonly>

                    </div>

                    <div class="form-group">
                        <label for="penerbit" class="text-capitalize">Penerbit</label>
                        <input type="text" class="form-control" id="penerbit" value="{{ $elibrary->penerbit }}"
                            placeholder="Masukan Nama Penerbit" readonly>

                    </div>

                    <div class="form-group">
                        <label for="foto_buku" class="text-capitalize">Foto Buku</label>
                        <div class="wrapper">
                            <img src="{{ asset('storage/elibrary-fotobuku/' . $elibrary->foto_buku) }}" style="width:256px; height:100%; object-fi: cover;" alt="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="jenis_buku" class="text-capitalize">Jenis Buku</label>
                        <input class="form-control" value="{{$elibrary->jenis_buku}}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="jumlah_buku" class="text-capitalize">Jumlah Buku</label>
                        <input type="text" class="form-control" id="jumlah_buku" value="{{ $elibrary->jumlah_buku }}"
                            placeholder="Masukan Jumlah Buku" readonly>

                    </div>

                    <div class="form-group">
                        <label for="deskripsi" class="text-capitalize">Deskripsi</label>
                        <textarea type="textarea" class="form-control" placeholder="Masukan Deskripsi Buku" readonly>{{ $elibrary->deskripsi }}"</textarea>

                    </div>

                    <div class="form-group">
                        <label for="file" class="text-capitalize">File Buku</label>
                        <input type="text" class="form-control" id="file" value="{{ $elibrary->file }}"
                        placeholder="Masukan Jumlah Buku" readonly>
                        <div class="wrapper">
                        <a href="{{ asset('storage/elibrary-pdf/' . $elibrary->file) }}" target="_blank">Preview PDF in New Tab</a>
                        </div>
                    </div>

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
