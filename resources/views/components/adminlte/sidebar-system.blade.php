@canany(['users-read', 'permissions-read', 'roles-read'])
    <li class="nav-header text-uppercase">System Control</li>

    @can('users-read')
        <li class="nav-item">
            <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-users-cog"></i>
                <p>
                    Users
                    {{-- <span class="right badge badge-danger">New</span> --}}
                </p>
            </a>
        </li>
    @endcan
    @can('permissions-read')
        <li class="nav-item">
            <a href="{{ route('admin.permissions.index') }}"
                class="nav-link {{ request()->routeIs('admin.permissions.*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-life-ring"></i>
                <p>
                    Permissions
                    {{-- <span class="right badge badge-danger">New</span> --}}
                </p>
            </a>
        </li>
    @endcan
    @can('roles-read')
        <li class="nav-item">
            <a href="{{ route('admin.roles.index') }}"
                class="nav-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                <i class="nav-icon far fa-life-ring"></i>
                <p>
                    Roles
                    {{-- <span class="right badge badge-danger">New</span> --}}
                </p>
            </a>
        </li>
    @endcan
@endcanany
