<div class="d-flex flex-column flex-md-row justify-content-center" style="gap: 0.5rem">
    @can('teachers-read')
        {{-- <a href="{{ route('admin.teachers.show', $model->id) }}" class="btn btn-sm btn-secondary">Preview</a> --}}
        <a type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#teacherPreview{{ $model->id }}">
            Preview
        </a>

        <div class="modal fade" id="teacherPreview{{ $model->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <img src="{{ asset('storage/teacherImages/' . $model->image) }}" style="width: 256px; height: 256px; object-fit: cover;">
                        </div>
                        <div class="form-group">
                            <label>Name :</label>
                            <input class="form-control" value="{{ $model->name }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Subjects:</label>
                            @if ($model && $model->subjects->count() > 0)
                            <input class="form-control" value="{{ $model->subjects->map(function ($subject) {
                                return $subject->name . ' (' . $subject->grade . ')';
                            })->implode(', ') }}" readonly>
                            @else
                                <input class="form-control" readonly value="No subjects assigned."></input>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>NIP :</label>
                            <input class="form-control" value="{{ $model->nip }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>NUPTK :</label>
                            <input class="form-control" value="{{ $model->nuptk }}" readonly>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    @endcan
    @can('teachers-update')
        <a href="{{ route('admin.teachers.edit', $model->id) }}" class="btn btn-sm btn-secondary">Edit</a>
    @endcan
    @can('teachers-delete')
        <span class="btn btn-sm btn-danger" id="deleteButton" data-model-id="{{ $model->id }}">Delete</span>
    @endcan
</div>
