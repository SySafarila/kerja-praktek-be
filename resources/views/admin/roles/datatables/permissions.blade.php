@if ($model->name == 'super admin')
    <span class="badge badge-success text-bold">ALL ACCESS</span>
@else
    @foreach ($model->permissions as $permission)
        <span class="badge badge-info">{{ $permission->name }}</span>
    @endforeach
@endif
