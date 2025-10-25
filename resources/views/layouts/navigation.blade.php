<nav x-data="{ open: false, userOpen: false }"
    class="fixed top-0 left-0 w-full bg-white/80 dark:bg-gray-900/80 backdrop-blur-md border-b border-gray-200 dark:border-gray-800 z-50 shadow-sm">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- Logo + Nombre -->
            <div class="flex items-center gap-3">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                    <x-application-logo class="h-8 w-auto text-indigo-600" />
                    <span class="text-xl font-bold text-indigo-700 dark:text-indigo-300 tracking-tight">MiApp</span>
                </a>
            </div>

            <!-- Links (Desktop) -->
            <div class="hidden md:flex md:items-center md:gap-6 font-medium">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    <i class="fa-solid fa-house text-indigo-600 mr-1"></i> Inicio
                </x-nav-link>

                @can('view products')
                    <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')">
                        <i class="fa-solid fa-box-open text-indigo-600 mr-1"></i> Productos
                    </x-nav-link>
                @endcan

                @can('view users')
                    <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')">
                        <i class="fa-solid fa-users text-indigo-600 mr-1"></i> Usuarios
                    </x-nav-link>
                @endcan

                @can('manage roles')
                    <x-nav-link :href="route('roles.index')" :active="request()->routeIs('roles.*')">
                        <i class="fa-solid fa-user-shield text-indigo-600 mr-1"></i> Roles y Permisos
                    </x-nav-link>
                @endcan

                <!-- Reportes (Próximamente) -->
                <span class="flex items-center gap-2 text-gray-500 cursor-not-allowed">
                    <i class="fa-solid fa-chart-bar"></i>
                    Reportes
                    <span class="bg-indigo-600 text-white text-xs px-2 py-0.5 rounded-full">Próximamente</span>
                </span>
            </div>

            <!-- Usuario (Desktop) -->
            <div class="hidden md:flex items-center gap-4">
                <!-- Badge de rol -->
                @if(Auth::user()->roles->isNotEmpty())
                    <span class="text-xs bg-indigo-100 text-indigo-700 font-semibold px-2 py-1 rounded-full">
                        {{ Auth::user()->roles->first()->name }}
                    </span>
                @endif

                <!-- Dropdown -->
                <div class="relative" x-data="{ openUser: false }" @click.away="openUser = false">
                    <button @click="openUser = !openUser"
                        class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                        <i class="fa-solid fa-user-circle text-indigo-600 text-lg"></i>
                        <span class="text-sm text-gray-700 dark:text-gray-200">{{ Auth::user()->name }}</span>
                        <i class="fa-solid fa-chevron-down text-gray-500 text-xs"></i>
                    </button>

                    <div x-show="openUser" x-transition
                        class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-md shadow-lg py-1 z-50">
                        <x-dropdown-link :href="route('profile.edit')">
                            <i class="fa-solid fa-user-gear mr-2 text-indigo-600"></i> Perfil
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="fa-solid fa-right-from-bracket mr-2 text-red-500"></i> Cerrar sesión
                            </x-dropdown-link>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Botón móvil -->
            <div class="md:hidden flex items-center">
                <button @click="open = !open"
                    class="p-2 rounded-md text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                    <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="open" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Menú móvil -->
    <div x-show="open" x-transition class="md:hidden bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800">
        <div class="px-4 py-3 space-y-1 font-medium">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                <i class="fa-solid fa-house mr-2 text-indigo-600"></i> Inicio
            </x-responsive-nav-link>

            @can('view products')
                <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')">
                    <i class="fa-solid fa-box-open mr-2 text-indigo-600"></i> Productos
                </x-responsive-nav-link>
            @endcan

            @can('view users')
                <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')">
                    <i class="fa-solid fa-users mr-2 text-indigo-600"></i> Usuarios
                </x-responsive-nav-link>
            @endcan

            @can('manage roles')
                <x-responsive-nav-link :href="route('roles.index')" :active="request()->routeIs('roles.*')">
                    <i class="fa-solid fa-user-shield mr-2 text-indigo-600"></i> Roles y Permisos
                </x-responsive-nav-link>
            @endcan

            <div class="px-3 py-2 text-sm text-gray-500 flex items-center justify-between">
                <span><i class="fa-solid fa-chart-bar mr-2"></i> Reportes</span>
                <span class="text-xs bg-indigo-600 text-white px-2 py-0.5 rounded-full">Próximamente</span>
            </div>

            <div class="border-t border-gray-100 dark:border-gray-800 pt-3">
                <div class="text-sm font-medium text-gray-800 dark:text-gray-200 flex items-center gap-2">
                    <i class="fa-solid fa-user-circle text-indigo-600"></i>
                    {{ Auth::user()->name }}
                </div>
                @if(Auth::user()->roles->isNotEmpty())
                    <div class="text-xs text-indigo-600 mt-1">
                        Rol: {{ Auth::user()->roles->first()->name }}
                    </div>
                @endif

                <x-responsive-nav-link :href="route('profile.edit')">
                    <i class="fa-solid fa-user-gear mr-2 text-indigo-600"></i> Perfil
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="fa-solid fa-right-from-bracket mr-2 text-red-500"></i> Cerrar sesión
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
