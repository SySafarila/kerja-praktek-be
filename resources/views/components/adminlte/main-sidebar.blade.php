<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('admin.index') }}" class="brand-link">
        <img src="{{ asset('adminlte-3.2.0/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle" style="opacity: .8">
        <span class="brand-text font-weight-light">Dashboard</span>
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
                @can('admin-access')
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
                    <li class="nav-header text-uppercase">Content Control</li>
                @endcan

                @canany(['staffs-read'])
                    @if (Route::has('admin.staffs.index'))
                        @can('staffs-read')
                            <li class="nav-item">
                                <a href="{{ route('admin.staffs.index') }}"
                                    class="nav-link {{ request()->routeIs('admin.staffs.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user-tie"></i>
                                    <p class="text-capitalize">
                                        staffs
                                        {{-- <span class="right badge badge-danger">New</span> --}}
                                    </p>
                                </a>
                            </li>
                        @endcan
                    @endif
                @endcanany
                @canany(['teachers-read'])
                    @if (Route::has('admin.teachers.index'))
                        @can('teachers-read')
                            <li class="nav-item">
                                <a href="{{ route('admin.teachers.index') }}"
                                    class="nav-link {{ request()->routeIs('admin.teachers.*') ? 'active' : '' }}">
                                    <i class="nav-icon fa fa-user-graduate"></i>
                                    <p class="text-capitalize">
                                        teachers
                                        {{-- <span class="right badge badge-danger">New</span> --}}
                                    </p>
                                </a>
                            </li>
                        @endcan
                    @endif
                @endcanany
                @canany(['subjects-read'])
                    @if (Route::has('admin.subjects.index'))
                        @can('subjects-read')
                            <li class="nav-item">
                                <a href="{{ route('admin.subjects.index') }}"
                                    class="nav-link {{ request()->routeIs('admin.subjects.*') ? 'active' : '' }}">
                                    <i class="nav-icon fa fa-tags"></i>
                                    <p class="text-capitalize">
                                        subjects
                                        {{-- <span class="right badge badge-danger">New</span> --}}
                                    </p>
                                </a>
                            </li>
                        @endcan
                    @endif
                @endcanany
                @canany(['extracurriculars-read'])
                    @if (Route::has('admin.extracurriculars.index'))
                        @can('extracurriculars-read')
                            <li class="nav-item">
                                <a href="{{ route('admin.extracurriculars.index') }}"
                                    class="nav-link {{ request()->routeIs('admin.extracurriculars.*') ? 'active' : '' }}">
                                    <i class="nav-icon fa fa-rocket"></i>
                                    <p class="text-capitalize">
                                        extracurriculars
                                        {{-- <span class="right badge badge-danger">New</span> --}}
                                    </p>
                                </a>
                            </li>
                        @endcan
                    @endif
                @endcanany
                @canany(['galleries-read'])
                    @if (Route::has('admin.galleries.index'))
                        @can('galleries-read')
                            <li class="nav-item">
                                <a href="{{ route('admin.galleries.index') }}"
                                    class="nav-link {{ request()->routeIs('admin.galleries.*') ? 'active' : '' }}">
                                    <i class="nav-icon fa fa-images"></i>
                                    <p class="text-capitalize">
                                        galleries
                                        {{-- <span class="right badge badge-danger">New</span> --}}
                                    </p>
                                </a>
                            </li>
                        @endcan
                    @endif
                @endcanany
                @canany(['news-read'])
                    @if (Route::has('admin.news.index'))
                        @can('news-read')
                            <li class="nav-item">
                                <a href="{{ route('admin.news.index') }}"
                                    class="nav-link {{ request()->routeIs('admin.news.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-newspaper"></i>
                                    <p class="text-capitalize">
                                        news
                                        {{-- <span class="right badge badge-danger">New</span> --}}
                                    </p>
                                </a>
                            </li>
                        @endcan
                    @endif
                @endcanany
                @canany(['articles-read'])
                    @if (Route::has('admin.articles.index'))
                        @can('articles-read')
                            <li class="nav-item">
                                <a href="{{ route('admin.articles.index') }}"
                                    class="nav-link {{ request()->routeIs('admin.articles.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-newspaper"></i>
                                    <p class="text-capitalize">
                                        articles
                                        {{-- <span class="right badge badge-danger">New</span> --}}
                                    </p>
                                </a>
                            </li>
                        @endcan
                    @endif
                @endcanany
                @canany(['testimonials-read'])
                    @if (Route::has('admin.testimonials.index'))
                        @can('testimonials-read')
                            <li class="nav-item">
                                <a href="{{ route('admin.testimonials.index') }}"
                                    class="nav-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user-edit"></i>
                                    <p class="text-capitalize">
                                        testimonials
                                        {{-- <span class="right badge badge-danger">New</span> --}}
                                    </p>
                                </a>
                            </li>
                        @endcan
                    @endif
                @endcanany
                @if (Route::has('admin.ppdb.index'))
                    @can('ppdb-read')
                        <li class="nav-item">
                            <a href="{{ route('admin.ppdb.index') }}"
                                class="nav-link {{ request()->routeIs('admin.ppdb.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-users"></i>
                                <p class="text-capitalize">
                                    PPDB
                                    {{-- <span class="right badge badge-danger">New</span> --}}
                                </p>
                            </a>
                        </li>
                    @endcan
                @endif
                @if (Route::has('admin.ppdb-settings.index'))
                    @can('ppdb-settings-read')
                        <li class="nav-item">
                            <a href="{{ route('admin.ppdb-settings.index') }}"
                                class="nav-link {{ request()->routeIs('admin.ppdb-settings.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-users-cog"></i>
                                <p class="text-capitalize">
                                    PPDB Settings
                                    {{-- <span class="right badge badge-danger">New</span> --}}
                                </p>
                            </a>
                        </li>
                    @endcan
                @endif

                @canany(['elibrary-read'])
                    @if (Route::has('admin.elibrary.index'))
                        @can('elibrary-read')
                            <li class="nav-item">
                                <a href="{{ route('admin.elibrary.index') }}"
                                    class="nav-link {{ request()->routeIs('admin.elibrary.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p class="text-capitalize">
                                        elibrary
                                        {{-- <span class="right badge badge-danger">New</span> --}}
                                    </p>
                                </a>
                            </li>
                        @endcan
                    @endif
                @endcanany

                @canany(['peminjaman-read'])
                    @if (Route::has('admin.elibraryadminpeminjaman.index'))
                        @can('peminjaman-read')
                            <li class="nav-item">
                                <a href="{{ route('admin.elibraryadminpeminjaman.index') }}"
                                    class="nav-link {{ request()->routeIs('admin.elibraryadminpeminjaman.*') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-book-open"></i>
                                    <p class="text-capitalize">
                                        Peminjaman Buku
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
                    <small class="d-block text-capitalize text-center" style="color: #c2c7d0;">Admin Panel By <a href="https://www.instagram.com/sysafarila/" target="_blank" rel="noopener noreferrer">SySafarila</a></small>
                </li>
            </ul>
        </nav>
    </div>
</aside>
