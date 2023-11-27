<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('admin.index') }}" class="brand-link">
        <img src="{{ asset('adminlte-3.2.0/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle" style="opacity: .8">
        <span class="brand-text font-weight-light">SySafarila</span>
    </a>

    <div class="sidebar">
        <div class="user-panel d-flex mt-3 mb-3 pb-3">
            <div class="image">
                <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('images/profile.png') }}"
                    class="img-circle" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('account.index') }}" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false" style="overflow-x: hidden;">
                <li class="nav-item">
                    <a href="{{ route('admin.index') }}"
                        class="nav-link {{ request()->routeIs('admin.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Home
                            {{-- <span class="right badge badge-danger">New</span> --}}
                        </p>
                    </a>
                </li>
                @canany(['blogs-read'])
                    <li class="nav-header text-uppercase">Content Control</li>

                    @if (Route::has('admin.blogs.index'))
                        @can('blogs-read')
                            <li class="nav-item">
                                <a href="{{ route('admin.blogs.index') }}"
                                    class="nav-link {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-newspaper"></i>
                                    <p>
                                        Blogs
                                        {{-- <span class="right badge badge-danger">New</span> --}}
                                    </p>
                                </a>
                            </li>
                        @endcan
                    @endif
                @endcanany
                <x-adminlte.sidebar-system />
                <li class="nav-item mt-2 pt-2" style="border-top: 1px solid #4f5962;">
                    <a href="{{ route('logout') }}" class="nav-link"
                        onclick="event.preventDefault();document.querySelector('#logoutForm').submit()">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                            {{-- <span class="right badge badge-danger">New</span> --}}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <small class="d-block text-capitalize text-center" style="color: #c2c7d0;">{{ config('app.version') }}</small>
                </li>
            </ul>
        </nav>
    </div>
</aside>
