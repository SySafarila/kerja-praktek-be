<div class="d-flex flex-column flex-md-row justify-content-center" style="gap: 0.5rem">
    @can('galleries-read')
        {{-- <a href="{{ route('admin.galleries.show', $model->id) }}" class="btn btn-sm btn-secondary">Preview</a> --}}

    <a type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#galleryPreview{{ $model->id }}">
        Preview
    </a>

    <div class="modal fade" id="galleryPreview{{ $model->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Showing data for <b>{{ $model->title }}</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="wrapper text-center mb-2">
                        <img src="{{ asset('storage/galleryThumbnails/' . $model->thumbnail) }}" style="width: full; height: 256px; object-fit: cover;">
                    </div>
                    <div class="form-group">
                        <label>Title :</label>
                        <input class="form-control" value="{{ $model->title }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Description :</label>
                        <textarea class="form-control" rows="6" readonly>{{ $model->description }}</textarea>
                    </div>
                    <label>Other Images :</label>
                    <div class="wrapper text-center mb-2">
                        @if ($model->images->count() > 0)
                            @foreach ($model->images->take(3) as $image)
                                <img src="{{ asset('storage/galleryImages/' . $image->images) }}" style="width: full; height: 128px; object-fit: cover; padding: 2px;" alt="Gallery Image">
                            @endforeach
                        @else
                            <p>No images in the gallery.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endcan
    @can('galleries-update')
        <a href="{{ route('admin.galleries.edit', $model->id) }}" class="btn btn-sm btn-secondary">Edit</a>
    @endcan
    @can('galleries-delete')
        <span class="btn btn-sm btn-danger" id="deleteButton" data-model-id="{{ $model->id }}">Delete</span>
    @endcan
</div>
