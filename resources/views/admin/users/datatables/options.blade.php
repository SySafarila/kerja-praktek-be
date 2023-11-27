<div class="d-flex flex-column flex-md-row justify-content-center" style="gap: 0.5rem">
    @can('users-update')
        <a href="{{ route('admin.users.edit', $model->id) }}" class="btn btn-sm btn-secondary">Edit</a>
    @endcan
    {{-- @can('users-read')
        <a href="{{ route('admin.users.show', $model->id) }}" class="btn btn-sm btn-secondary">Show</a>
    @endcan --}}
    @can('users-delete')
        <span class="btn btn-sm btn-danger" id="deleteButton" data-model-id="{{ $model->id }}">Delete</span>
    @endcan
</div>
