<div class="d-flex flex-column flex-md-row justify-content-center" style="gap: 0.5rem">
    @can('articles-read')
        <a href="{{ route('admin.articles.show', $model->id) }}" class="btn btn-sm btn-secondary">Preview</a>
    @endcan
    @can('articles-update')
        <a href="{{ route('admin.articles.edit', $model->id) }}" class="btn btn-sm btn-secondary">Edit</a>
    @endcan
    @can('articles-delete')
        <span class="btn btn-sm btn-danger" id="deleteButton" data-model-id="{{ $model->id }}">Delete</span>
    @endcan
</div>
