<div class="d-flex flex-column flex-md-row justify-content-center" style="gap: 0.5rem">
    @can('blogs-read')
        <a href="{{ route('admin.blogs.show', $model->id) }}" class="btn btn-sm btn-secondary">Preview</a>
    @endcan
    @can('blogs-update')
        <a href="{{ route('admin.blogs.edit', $model->id) }}" class="btn btn-sm btn-secondary">Edit</a>
    @endcan
    @can('blogs-delete')
        <span class="btn btn-sm btn-danger" id="deleteButton" data-model-id="{{ $model->id }}">Delete</span>
    @endcan
</div>
