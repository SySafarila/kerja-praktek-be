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
                <form action="{{ route('admin.elibraryadminpeminjaman.update',$peminjaman->id) }}" method="POST"
                    enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="nama" class="text-capitalize">Nama Peminjam</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                value="{{ $peminjaman->nama }}" required>
                        </div>

                        <div class="form-group">
                            <label for="jenis" class="text-capitalize">Jenis Buku</label>
                            <select class="form-control" id="jenis" name="jenis" required onchange="filterBooks()">
                                <option value="Kelas 10" {{ $peminjaman->jenis === 'Kelas 10' ? 'selected' : '' }}>Kelas 10
                                </option>
                                <option value="Kelas 11" {{ $peminjaman->jenis === 'Kelas 11' ? 'selected' : '' }}>Kelas 11
                                </option>
                                <option value="Kelas 12" {{ $peminjaman->jenis === 'Kelas 12' ? 'selected' : '' }}>Kelas 12
                                </option>
                                <option value="Makalah" {{ $peminjaman->jenis === 'Makalah' ? 'selected' : '' }}>Makalah
                                </option>
                                <option value="Lainnya" {{ $peminjaman->jenis === 'Lainnya' ? 'selected' : '' }}>Lainnya
                                </option>
                            </select>
                            @error('jenis')
                                <div class="text-sm text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="book_id" class="text-capitalize">Nama Buku</label>
                            <select class="form-control" id="book_id" name="book_id" required>
                                @foreach ($books as $book)
                                    <option value="{{ $book->id }}" data-jenis="{{ $book->jenis_buku }}">
                                        {{ $book->nama_buku }}
                                    </option>
                                @endforeach
                            </select>
                            @error('book_id')
                                <div class="text-sm text-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="jumlah" class="text-capitalize">Jumlah</label>
                            <input type="text" class="form-control" id="jumlah" name="jumlah"
                                   pattern="[0-9]+" title="Please enter only numeric values" value="{{ $peminjaman->jumlah }}" required>
                            @error('jumlah')
                                <div class="text-sm text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tanggal_peminjaman" class="text-capitalize">Tanggal Peminjaman</label>
                            <input type="date" class="form-control" id="tanggal_peminjaman" name="tanggal_peminjaman"
                                   value="{{ old('tanggal_peminjaman', $peminjaman->tanggal_peminjaman) }}" required>
                            @error('tanggal_peminjaman')
                                <div class="text-sm text-danger">{{ $message }}</div>
                            @enderror
                        </div>



                        <div class="form-group">
                            <label for="status" class="text-capitalize">Status Pengembalian</label>
                            <select class="form-control" id="status" name="status" required onchange="filterBooks()">
                                <option value="Belum Dikembalikan" {{ $peminjaman->status === 'Belum Dikembalikan' ? 'selected' : '' }}>Belum Dikembalikan
                                </option>
                                <option value="Sudah Dikembalikan" {{ $peminjaman->status === 'Sudah Dikembalikan' ? 'selected' : '' }}>Sudah Dikembalikan
                                </option>

                            </select>
                            @error('status')
                                <div class="text-sm text-danger">{{ $message }}</div>
                            @enderror
                        </div>

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
    // Initialize the selected jenis buku and book_id
    var selectedJenisBuku = '{{ $peminjaman->jenis }}';
    var selectedBookId = '{{ $peminjaman->book_id }}';

    function filterBooks() {
        var jenisBuku = document.getElementById("jenis").value;
        var bookDropdown = document.getElementById("book_id");

        console.log('Selected Jenis Buku:', selectedJenisBuku);
        console.log('Selected Book ID:', selectedBookId);

        // Clear the dropdown options
        bookDropdown.innerHTML = '';

        // Add a default option
        var defaultOption = document.createElement("option");
        defaultOption.value = '';
        defaultOption.text = '---';
        bookDropdown.appendChild(defaultOption);

        // Add book options based on jenis buku
        @foreach ($books as $book)
            if ('{{ $book->jenis_buku }}' === jenisBuku) {
                var option = document.createElement("option");
                option.value = '{{ $book->id }}';
                option.text = '{{ $book->nama_buku }}';
                bookDropdown.appendChild(option);
            }
        @endforeach

        // Set the selected book
        bookDropdown.value = selectedBookId;
    }

    // Initial filtering on page load
    document.addEventListener("DOMContentLoaded", function () {
        filterBooks();
    });

    // Trigger filtering when jenis dropdown changes
    document.getElementById("jenis").addEventListener("change", function () {
        filterBooks();
    });
</script>








    {{-- jQuery --}}
    <script src="{{ asset('adminlte-3.2.0/plugins/jquery/jquery.min.js') }}"></script>
    {{-- Bootstrap 4 --}}
    <script src="{{ asset('adminlte-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
@endsection
