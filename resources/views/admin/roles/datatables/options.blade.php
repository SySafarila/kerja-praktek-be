<div class="d-flex flex-column flex-md-row justify-content-center" style="gap: 0.5rem">
    @can('roles-update')
        <a href="{{ route('admin.roles.edit', $model->id) }}" class="btn btn-sm btn-secondary">Edit</a>
    @endcan
    @can('roles-delete')
        <span class="btn btn-sm btn-danger" id="deleteButton" data-model-id="{{ $model->id }}">Delete</span>
    @endcan
</div>
