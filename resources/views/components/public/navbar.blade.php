<nav class="bg-accent-1 fixed w-full top-0 left-0 z-50 py-1">
    <div class="max-w-screen-lg mx-auto flex flex-col lg:flex-row justify-between px-5 py-2 lg:py-1.5">
        <div class="flex justify-between w-full">
            <a href="/" class="flex gap-2 items-center hover:no-underline">
                <img src="{{ asset('images/logos/logo2b.png') }}" alt="" class="h-12 w-auto">
                <div class="flex flex-col justify-center">
                    <span class="font-light text-sm text-accent-2">Lembaga Pendidikan NU</span>
                    <span class="font-bold text-accent-2 -mt-1">SMA MA'ARIF PACET</span>
                </div>
            </a>
            <button type="button" class="material-icons lg:hidden text-accent-4" id="navbar-menu">menu</button>
        </div>
        <div class="flex flex-col lg:flex lg:flex-row lg:items-center lg:gap-8 gap-2 py-2.5 lg:py-0 hidden"
            id="navbar-menus" style="text-decoration: none">
            <a href="/" class="text-accent-2 hover:text-orange-200 transition text-sm"
                style="text-decoration: none">Home</a>
            <a href="{{ route('news') }}" class="text-accent-2 hover:text-orange-200 transition text-sm"
                style="text-decoration: none">News</a>
            <a href="{{ route('galleries') }}" class="text-accent-2 hover:text-orange-200 transition text-sm"
                style="text-decoration: none">Galleries</a>
            <a href="{{ route('extracurriculars') }}" class="text-accent-2 hover:text-orange-200 transition text-sm"
                style="text-decoration: none">Extracurriculars</a>
            <a href="#" class="text-accent-2 hover:text-orange-200 transition text-sm"
                style="text-decoration: none">PPDB</a>

            @auth
                <div class="relative group" x-data="{ open: false }">
                    <button @click="open = !open" id="toggleButton"
                        class="flex text-accent-2 transition text-sm font-semibold focus:outline-none">
                        {{ explode(' ', auth()->user()->name)[0] }}
                        <span :class="{ 'fa-angle-up': open, 'fa-angle-down': !open }" id="icon"
                            class="fa text-accent-2 pl-1 text-sm"></span>
                    </button>

                    <div x-show="open" @click.away="open = false"
                        class="absolute lg:right-0 mt-5 w-48 bg-white rounded-sm overflow-hidden shadow-lg z-10"
                        style="display: none;">
                        <p style="text-decoration: none; line-height: 1.5rem;"
                            class="block px-4 py-2 text-sm border-b-2 text-gray-700 whitespace-nowrap overflow-hidden">
                            Hi, <b>{{ auth()->user()->name }}</b>
                        </p>

                        @role(['admin', 'super admin'])
                            <a href="{{ route('dashboard') }}" style="text-decoration: none;"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-accent-6 hover:text-accent-2">Dashboard</a>
                        @endrole

                        <a href="{{ route('ppdb.index') }}" style="text-decoration: none;"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-accent-6 hover:text-accent-2">PPDB</a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"
                                style="text-decoration: none;"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-accent-6 hover:text-accent-2">Logout</a>
                        </form>
                    </div>
                </div>
            @else
                <div class="flex gap-x-2 justify-center lg:">
                    <a href="{{ route('login') }}"
                        class="px-2 border text-accent-2 hover:text-accent-1 hover:bg-white transition text-sm"
                        style="text-decoration: none">Login</a>
                    <a href="{{ route('register') }}"
                        class="px-2 border text-accent-2 hover:text-accent-1 hover:bg-white transition text-sm"
                        style="text-decoration: none">Register</a>
                    {{-- <a href="{{ route('register') }}" class=" text-accent-2 hover:text-yellow-200 transition text-sm"
                    style="text-decoration: none">Register</a> --}}
                </div>
            @endauth

        </div>
    </div>
</nav>
