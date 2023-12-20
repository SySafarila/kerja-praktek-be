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
                    <h1 class="m-0">Menambahkan Buku</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item text-capitalize"><a
                                href="{{ route('admin.elibrary.index') }}">elibrary</a>
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
                <form action="{{ route('admin.elibrary.store') }}" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <label for="nama_buku" class="text-capitalize">Nama Buku</label>
                            <input type="text" class="form-control" id="nama_buku" name="nama_buku" placeholder="Masukan Nama Buku" required>
                            @error('nama_buku')
                                <div class="text-sm text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="penulis" class="text-capitalize">Penulis</label>
                            <input type="text" class="form-control" id="penulis" name="penulis" placeholder="Masukan Nama Penulis">
                            @error('penulis')
                                <div class="text-sm text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="penerbit" class="text-capitalize">Penerbit</label>
                            <input type="text" class="form-control" id="penerbit" name="penerbit" placeholder="Masukan Nama Penerbit">
                            @error('penerbit')
                                <div class="text-sm text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="foto_buku" class="text-capitalize">Foto Buku</label>
                            <input type="file" class="form-control-file" id="foto_buku" name="foto_buku" accept="image/*" required>
                            @error('foto_buku')
                                <div class="text-sm text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="jenis_buku" class="text-capitalize">Jenis Buku</label>
                            <select class="form-control" id="jenis_buku" name="jenis_buku" required>
                                <option value="Kelas 10">Kelas 10</option>
                                <option value="Kelas 11">Kelas 11</option>
                                <option value="Kelas 12">Kelas 12</option>
                                <option value="Makalah">Makalah</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                            @error('jenis_buku')
                                <div class="text-sm text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="jumlah_buku" class="text-capitalize">Jumlah Buku</label>
                            <input type="text" class="form-control" id="jumlah_buku" name="jumlah_buku" placeholder="Masukan Jumlah Buku">
                            @error('jumlah_buku')
                            <div class="text-sm text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="deskripsi" class="text-capitalize">Deskripsi</label>
                            <textarea type="textarea" class="form-control" id="deskripsi" name="deskripsi" placeholder="Masukan Deskripsi Buku"  rows="12" required></textarea>
                            @error('deskripsi')
                            <div class="text-sm text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="file" class="text-capitalize">File Buku</label>
                            <input type="file" class="form-control-file" id="file" name="file" accept=".pdf">
                            @error('file')
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
