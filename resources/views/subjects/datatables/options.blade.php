<div class="d-flex flex-column flex-md-row justify-content-center" style="gap: 0.5rem">
    @can('subjects-update')
        <a href="{{ route('admin.subjects.edit', $model->id) }}" class="btn btn-sm btn-secondary">Edit</a>
    @endcan
    @can('subjects-delete')
        <span class="btn btn-sm btn-danger" id="deleteButton" data-model-id="{{ $model->id }}">Delete</span>
    @endcan
</div>
