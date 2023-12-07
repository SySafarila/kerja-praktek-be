<div class="d-flex flex-column flex-md-row justify-content-center" style="gap: 0.5rem">
    @can('news-read')
        <a href="{{ route('admin.news.show', $model->id) }}" class="btn btn-sm btn-secondary">Preview</a>
    @endcan
    @can('news-update')
        <a href="{{ route('admin.news.edit', $model->id) }}" class="btn btn-sm btn-secondary">Edit</a>
    @endcan
    @can('news-delete')
        <span class="btn btn-sm btn-danger" id="deleteButton" data-model-id="{{ $model->id }}">Delete</span>
    @endcan
</div>
