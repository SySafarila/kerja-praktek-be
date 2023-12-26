<div class="d-flex flex-column flex-md-row justify-content-center" style="gap: 0.5rem">
    @can('elibrary-read')
        <a href="{{ route('admin.elibrary.show', $model->id) }}" class="btn btn-sm btn-secondary">Preview</a>
    @endcan
    @can('elibrary-update')
        <a href="{{ route('admin.elibrary.edit', $model->id) }}" class="btn btn-sm btn-secondary">Edit</a>
    @endcan
    @can('elibrary-delete')
        <span class="btn btn-sm btn-danger" id="deleteButton" data-model-id="{{ $model->id }}">Delete</span>
    @endcan
</div>
