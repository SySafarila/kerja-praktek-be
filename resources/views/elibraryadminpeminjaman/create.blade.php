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
                    <h1 class="m-0">Daftar Peminjaman Buku</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item text-capitalize"><a
                                href="{{ route('admin.elibraryadminpeminjaman.index') }}">Peminjaman</a>
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
                <form action="{{ route('admin.elibraryadminpeminjaman.store') }}" method="POST"
                    enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <label for="nama" class="text-capitalize">Peminjam</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                placeholder="Masukan Nama Peminjam..." required>
                            @error('nama_buku')
                                <div class="text-sm text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="jenis" class="text-capitalize">Jenis Buku</label>
                            <select class="form-control" id="jenis" name="jenis" required onchange="filterBooks()">
                                <option selected disabled>Pilih jenis buku</option>
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
                            <label for="book_id" class="text-capitalize">Nama Buku</label>
                            <select class="form-control" id="book_id" name="book_id" required disabled>
                                <option value="">---</option>
                                @foreach ($books as $book)
                                    <option value="{{ $book->id }}" data-jenis="{{ $book->jenis_buku }}">
                                        {{ $book->nama_buku }}</option>
                                @endforeach
                            </select>
                            @error('book_id')
                                <div class="text-sm text-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="jumlah" class="text-capitalize">Jumlah</label>
                            <input type="text" class="form-control" id="jumlah" name="jumlah"
                                placeholder="Masukan Jumlah Buku yang dipinjam" required>
                            @error('penerbit')
                                <div class="text-sm text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tanggal_peminjaman" class="text-capitalize">Tanggal Peminjaman</label>
                            <input type="date" class="form-control" id="tanggal_peminjaman" name="tanggal_peminjaman"
                                required>
                            @error('penerbit')
                                <div class="text-sm text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status" class="text-capitalize">Status Pengembalian</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="Belum Dikembalikan">Belum Dikembalikan</option>
                                <option value="Sudah Dikembalikan">Sudah Dikembalikan</option>
                            </select>
                            @error('status')
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
    <script>
        function filterBooks() {
            var selectedJenis = document.getElementById('jenis').value;
            var bookDropdown = document.getElementById('book_id');

            // merubah default
            bookDropdown.value = '';

            for (var i = 0; i < bookDropdown.options.length; i++) {
                bookDropdown.options[i].style.display = 'none';
            }

            // membalikan disabled jadi enabled
            bookDropdown.disabled = selectedJenis === '';

            for (var i = 0; i < bookDropdown.options.length; i++) {
                var jenisBuku = bookDropdown.options[i].getAttribute('data-jenis');
                if (jenisBuku === selectedJenis || selectedJenis === '') {
                    bookDropdown.options[i].style.display = '';
                }
            }
        }
    </script>
    {{-- jQuery --}}
    <script src="{{ asset('adminlte-3.2.0/plugins/jquery/jquery.min.js') }}"></script>
    {{-- Bootstrap 4 --}}
    <script src="{{ asset('adminlte-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
@endsection
