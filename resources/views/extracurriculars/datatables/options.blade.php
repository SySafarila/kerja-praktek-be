<div class="d-flex flex-column flex-md-row justify-content-center" style="gap: 0.5rem">
    @can('extracurriculars-read')
        {{-- <a href="{{ route('admin.extracurriculars.show', $model->id) }}" class="btn btn-sm btn-secondary">Preview</a> --}}
        <a type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#extracurricularPreview{{ $model->id }}">
            Preview
        </a>

        <div class="modal fade" id="extracurricularPreview{{ $model->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Showing data for <b>{{ $model->name }}</b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="wrapper text-center mb-2">
                            <img src="{{ asset('storage/extracurricularImages/' . $model->image) }}" style="width: full; height: 256px; object-fit: cover;" class="rounded">
                        </div>
                        <div class="form-group">
                            <label>Name :</label>
                            <input class="form-control" value="{{ $model->name }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Schedule :</label>
                            <input class="form-control" value="{{ implode(', ', json_decode($model->schedule)) }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Location :</label>
                            <input class="form-control" value="{{ $model->location }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Description :</label>
                            <textarea class="form-control" readonly>{{ $model->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Mentor :</label>
                            <input class="form-control" value="{{ $model->mentor ? $model->mentor->name : 'No Mentor' }}" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endcan
    @can('extracurriculars-update')
        <a href="{{ route('admin.extracurriculars.edit', $model->id) }}" class="btn btn-sm btn-secondary">Edit</a>
    @endcan
    @can('extracurriculars-delete')
        <span class="btn btn-sm btn-danger" id="deleteButton" data-model-id="{{ $model->id }}">Delete</span>
    @endcan
</div>
