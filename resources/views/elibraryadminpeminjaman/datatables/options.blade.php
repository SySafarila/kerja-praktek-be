<div class="d-flex flex-column flex-md-row justify-content-center" style="gap: 0.5rem">
    @can('peminjaman-read')
        <!-- <a href="{{ route('admin.elibraryadminpeminjaman.show', $model->id) }}" class="btn btn-sm btn-primary">Preview</a> -->

        <a type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#preview{{ $model->id }}">
            Preview
        </a>

        <div class="modal fade" id="preview{{ $model->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Showing data for <b>{{ $model->nama }}</b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama" class="text-capitalize">Peminjam</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                value="{{ $model->nama }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="jenis" class="text-capitalize">Jenis Buku</label>
                            <input type="text" class="form-control" id="jenis" name="jenis"
                                value="{{ $model->jenis }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="book_id" class="text-capitalize">Nama Buku</label>
                            <input type="text" class="form-control" id="book_id" name="book_id"
                                value="{{ $model->buku->nama_buku }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="jumlah" class="text-capitalize">Jumlah</label>
                            <input type="text" class="form-control" id="jumlah" name="jumlah"
                                value="{{ $model->jumlah }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="tanggal_peminjaman" class="text-capitalize">Tanggal Peminjaman</label>
                            <input type="text" class="form-control" id="tanggal_peminjaman" name="tanggal_peminjaman"
                                value="{{ $model->tanggal_peminjaman }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="status" class="text-capitalize">Status Pengembalian</label>
                            <input type="text" class="form-control" id="status" name="status"
                                value="{{ $model->status }}" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan
    @can('peminjaman-update')
        <a href="{{ route('admin.elibraryadminpeminjaman.edit', $model->id) }}" class="btn btn-sm btn-secondary">Edit</a>
    @endcan
    @can('peminjaman-delete')
        <span class="btn btn-sm btn-danger" id="deleteButton" data-model-id="{{ $model->id }}">Delete</span>
    @endcan
</div>
