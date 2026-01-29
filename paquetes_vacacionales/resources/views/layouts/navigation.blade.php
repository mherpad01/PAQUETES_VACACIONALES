<nav x-data="{ open: false, scrolled: false }" 
     x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 20 })"
     :class="scrolled ? 'shadow-lg bg-white/98 backdrop-blur-sm' : 'shadow-md bg-white'"
     class="sticky top-0 z-50 transition-all duration-500">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            
            <!-- Logo Section - Con imagen de Unsplash -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center group">
                    <!-- Logo con imagen -->
                    <div class="relative overflow-hidden rounded-xl shadow-md group-hover:shadow-lg transition-all duration-300">
                        <img src="https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=120&h=120&fit=crop&q=80" 
                             alt="Wanderluxe Logo" 
                             class="w-11 h-11 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-br from-sky-500/20 to-blue-600/20 group-hover:from-sky-500/10 group-hover:to-blue-600/10 transition-all duration-300"></div>
                    </div>
                    
                    <div class="ml-3">
                        <div class="text-xl font-bold bg-gradient-to-r from-sky-600 via-blue-600 to-indigo-600 bg-clip-text text-transparent group-hover:from-sky-700 group-hover:via-blue-700 group-hover:to-indigo-700 transition-all duration-300">
                            Wanderluxe
                        </div>
                        <div class="text-[9px] text-gray-500 font-medium tracking-[0.15em] uppercase">
                            Escape • Explore • Experience
                        </div>
                    </div>
                </a>
            </div>

            <!-- Auth Buttons o User Info (Desktop) -->
            <div class="hidden sm:flex items-center space-x-3">
                @auth
                    <!-- Role Badge -->
                    @if(auth()->user()->isAdmin())
                        <div class="px-3 py-1 rounded-full bg-red-50 border border-red-200 text-red-700 text-xs font-semibold">
                            <i class="fas fa-crown mr-1"></i>Admin
                        </div>
                    @elseif(auth()->user()->isAdvanced())
                        <div class="px-3 py-1 rounded-full bg-amber-50 border border-amber-200 text-amber-700 text-xs font-semibold">
                            <i class="fas fa-star mr-1"></i>Advanced
                        </div>
                    @endif

                    <!-- User Avatar con nombre -->
                    <div class="flex items-center space-x-2 px-3 py-1.5 rounded-lg bg-gray-50 border border-gray-200">
                        <div class="w-7 h-7 rounded-full bg-gradient-to-br from-sky-600 to-blue-700 flex items-center justify-center text-white text-xs font-semibold shadow-sm">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <span class="text-sm font-medium text-gray-700 hidden md:block">
                            {{ Str::limit(Auth::user()->name, 12) }}
                        </span>
                    </div>
                @else
                    <!-- Guest Buttons -->
                    <a href="{{ route('login') }}" 
                       class="px-4 py-2 rounded-lg font-medium text-sm text-gray-700 hover:bg-gray-100 transition-all duration-300">
                        Iniciar Sesión
                    </a>
                    
                    <a href="{{ route('register') }}" 
                       class="px-4 py-2 rounded-lg text-white font-medium text-sm bg-gradient-to-r from-sky-600 to-blue-700 hover:from-sky-700 hover:to-blue-800 shadow-sm hover:shadow-md transition-all duration-300">
                        Registrarse
                    </a>
                @endauth
            </div>

            <!-- Hamburger Button -->
            <button @click="open = !open" 
                    type="button"
                    class="p-2 rounded-lg text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-sky-500 transition-colors duration-300">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!open" 
                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M4 6h16M4 12h16M4 18h16" />
                    <path x-show="open" 
                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu (Slide-in Panel) - Animaciones mejoradas -->
    <div x-cloak
         x-show="open" 
         x-transition:enter="transition-transform ease-out duration-300"
         x-transition:enter-start="translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition-transform ease-in duration-250"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="translate-x-full"
         @click.outside="open = false"
         class="fixed inset-y-0 right-0 w-80 bg-white shadow-2xl z-50 overflow-y-auto">
        
        <!-- Panel Header -->
        <div class="bg-gradient-to-br from-gray-50 to-white p-6 border-b border-gray-200">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center">
                    <div class="relative overflow-hidden rounded-xl shadow-md">
                        <img src="https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=120&h=120&fit=crop&q=80" 
                             alt="Wanderluxe" 
                             class="w-11 h-11 object-cover">
                        <div class="absolute inset-0 bg-gradient-to-br from-sky-500/20 to-blue-600/20"></div>
                    </div>
                    <div class="ml-3">
                        <div class="text-lg font-bold bg-gradient-to-r from-sky-600 via-blue-600 to-indigo-600 bg-clip-text text-transparent">
                            Wanderluxe
                        </div>
                        <div class="text-[9px] text-gray-500 font-medium tracking-[0.15em] uppercase">
                            Escape • Explore
                        </div>
                    </div>
                </div>
                <button @click="open = false" 
                        type="button"
                        class="text-gray-400 hover:text-gray-600 p-2 rounded-lg hover:bg-gray-100 transition-colors duration-300">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>

            @auth
                <!-- User Info Card -->
                <div class="bg-white rounded-lg p-4 border border-gray-200 shadow-sm">
                    <div class="flex items-center mb-3">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-sky-600 to-blue-700 flex items-center justify-center text-white font-semibold shadow-sm">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div class="ml-3 flex-1">
                            <div class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</div>
                            <div class="text-xs text-gray-500">{{ Str::limit(Auth::user()->email, 25) }}</div>
                        </div>
                    </div>
                    
                    @if(auth()->user()->isAdmin())
                        <div class="inline-flex items-center px-2.5 py-1 rounded-full bg-red-50 border border-red-200 text-red-700 text-xs font-semibold">
                            <i class="fas fa-crown mr-1"></i>Administrador
                        </div>
                    @elseif(auth()->user()->isAdvanced())
                        <div class="inline-flex items-center px-2.5 py-1 rounded-full bg-amber-50 border border-amber-200 text-amber-700 text-xs font-semibold">
                            <i class="fas fa-star mr-1"></i>Avanzado
                        </div>
                    @endif
                </div>
            @endauth
        </div>

        <!-- Navigation Links -->
        <div class="p-4 space-y-1">
            
            <!-- Inicio -->
            <a href="{{ route('home') }}" 
               @click="open = false"
               class="flex items-center px-4 py-3 rounded-lg font-medium transition-all duration-300 {{ request()->routeIs('home') ? 'bg-sky-50 text-sky-700' : 'text-gray-700 hover:bg-gray-50' }}">
                <div class="w-8 h-8 rounded-lg {{ request()->routeIs('home') ? 'bg-sky-100 text-sky-600' : 'bg-gray-100 text-gray-500' }} flex items-center justify-center mr-3 transition-colors duration-300">
                    <i class="fas fa-home text-sm"></i>
                </div>
                <span class="flex-1">Inicio</span>
                @if(request()->routeIs('home'))
                    <i class="fas fa-chevron-right text-sky-600 text-xs"></i>
                @endif
            </a>

            <!-- Destinos -->
            <a href="{{ route('vacaciones.index') }}" 
               @click="open = false"
               class="flex items-center px-4 py-3 rounded-lg font-medium transition-all duration-300 {{ request()->routeIs('vacaciones.*') && !request()->routeIs('vacaciones.create') ? 'bg-sky-50 text-sky-700' : 'text-gray-700 hover:bg-gray-50' }}">
                <div class="w-8 h-8 rounded-lg {{ request()->routeIs('vacaciones.*') && !request()->routeIs('vacaciones.create') ? 'bg-sky-100 text-sky-600' : 'bg-gray-100 text-gray-500' }} flex items-center justify-center mr-3 transition-colors duration-300">
                    <i class="fas fa-globe-americas text-sm"></i>
                </div>
                <span class="flex-1">Destinos</span>
                @if(request()->routeIs('vacaciones.*') && !request()->routeIs('vacaciones.create'))
                    <i class="fas fa-chevron-right text-sky-600 text-xs"></i>
                @endif
            </a>

            @auth
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}" 
                   @click="open = false"
                   class="flex items-center px-4 py-3 rounded-lg font-medium transition-all duration-300 {{ request()->routeIs('dashboard') ? 'bg-purple-50 text-purple-700' : 'text-gray-700 hover:bg-gray-50' }}">
                    <div class="w-8 h-8 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-purple-100 text-purple-600' : 'bg-gray-100 text-gray-500' }} flex items-center justify-center mr-3 transition-colors duration-300">
                        <i class="fas fa-th-large text-sm"></i>
                    </div>
                    <span class="flex-1">Dashboard</span>
                    @if(request()->routeIs('dashboard'))
                        <i class="fas fa-chevron-right text-purple-600 text-xs"></i>
                    @endif
                </a>

                <!-- Mis Reservas -->
                <a href="{{ route('reservas.mis-reservas') }}" 
                   @click="open = false"
                   class="flex items-center px-4 py-3 rounded-lg font-medium transition-all duration-300 {{ request()->routeIs('reservas.*') ? 'bg-pink-50 text-pink-700' : 'text-gray-700 hover:bg-gray-50' }}">
                    <div class="w-8 h-8 rounded-lg {{ request()->routeIs('reservas.*') ? 'bg-pink-100 text-pink-600' : 'bg-gray-100 text-gray-500' }} flex items-center justify-center mr-3 transition-colors duration-300">
                        <i class="fas fa-suitcase text-sm"></i>
                    </div>
                    <span class="flex-1">Mis Reservas</span>
                    @if(request()->routeIs('reservas.*'))
                        <i class="fas fa-chevron-right text-pink-600 text-xs"></i>
                    @endif
                </a>

                <!-- Mi Perfil -->
                <a href="{{ route('profile.edit') }}" 
                   @click="open = false"
                   class="flex items-center px-4 py-3 rounded-lg font-medium transition-all duration-300 {{ request()->routeIs('profile.*') ? 'bg-green-50 text-green-700' : 'text-gray-700 hover:bg-gray-50' }}">
                    <div class="w-8 h-8 rounded-lg {{ request()->routeIs('profile.*') ? 'bg-green-100 text-green-600' : 'bg-gray-100 text-gray-500' }} flex items-center justify-center mr-3 transition-colors duration-300">
                        <i class="fas fa-user-circle text-sm"></i>
                    </div>
                    <span class="flex-1">Mi Perfil</span>
                    @if(request()->routeIs('profile.*'))
                        <i class="fas fa-chevron-right text-green-600 text-xs"></i>
                    @endif
                </a>

                @if(auth()->user()->isAdmin())
                    <div class="my-2 h-px bg-gray-200"></div>
                    
                    <!-- Gestión Usuarios -->
                    <a href="{{ route('admin.users.index') }}" 
                       @click="open = false"
                       class="flex items-center px-4 py-3 rounded-lg font-medium transition-all duration-300 {{ request()->routeIs('admin.users.*') ? 'bg-red-50 text-red-700' : 'text-gray-700 hover:bg-gray-50' }}">
                        <div class="w-8 h-8 rounded-lg {{ request()->routeIs('admin.users.*') ? 'bg-red-100 text-red-600' : 'bg-gray-100 text-gray-500' }} flex items-center justify-center mr-3 transition-colors duration-300">
                            <i class="fas fa-users-cog text-sm"></i>
                        </div>
                        <span class="flex-1">Gestión de Usuarios</span>
                        @if(request()->routeIs('admin.users.*'))
                            <i class="fas fa-chevron-right text-red-600 text-xs"></i>
                        @endif
                    </a>
                @endif

                @if(auth()->user()->canCreateVacaciones())
                    <div class="my-2 h-px bg-gray-200"></div>
                    
                    <!-- Crear Paquete -->
                    <a href="{{ route('vacaciones.create') }}" 
                       @click="open = false"
                       class="flex items-center px-4 py-3 rounded-lg font-semibold bg-gradient-to-r from-amber-500 to-orange-600 text-white shadow-sm hover:shadow-md transition-all duration-300">
                        <div class="w-8 h-8 rounded-lg bg-white/20 flex items-center justify-center mr-3">
                            <i class="fas fa-plus-circle text-sm"></i>
                        </div>
                        <span class="flex-1">Crear Paquete</span>
                        <i class="fas fa-chevron-right text-xs"></i>
                    </a>
                @endif

                <!-- Logout -->
                <div class="mt-2 pt-2 border-t border-gray-200">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" 
                                class="w-full flex items-center px-4 py-3 rounded-lg font-medium text-red-600 hover:bg-red-50 transition-all duration-300">
                            <div class="w-8 h-8 rounded-lg bg-red-50 flex items-center justify-center mr-3">
                                <i class="fas fa-sign-out-alt text-sm"></i>
                            </div>
                            <span class="flex-1 text-left">Cerrar Sesión</span>
                        </button>
                    </form>
                </div>
            @else
                <!-- Guest Links -->
                <div class="mt-2 pt-2 border-t border-gray-200 space-y-2">
                    <a href="{{ route('login') }}" 
                       @click="open = false"
                       class="flex items-center justify-center px-4 py-3 rounded-lg font-medium border border-gray-300 text-gray-700 hover:border-sky-600 hover:bg-sky-50 hover:text-sky-600 transition-all duration-300">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Iniciar Sesión
                    </a>
                    
                    <a href="{{ route('register') }}" 
                       @click="open = false"
                       class="flex items-center justify-center px-4 py-3 rounded-lg text-white font-semibold bg-gradient-to-r from-sky-600 to-blue-700 shadow-sm hover:shadow-md transition-all duration-300">
                        <i class="fas fa-user-plus mr-2"></i>
                        Registrarse
                    </a>
                </div>
            @endauth
        </div>

        <!-- Panel Footer -->
        <div class="sticky bottom-0 p-4 bg-gray-50 border-t border-gray-200 text-center">
            <p class="text-xs text-gray-500 font-medium">
                © {{ date('Y') }} Wanderluxe
            </p>
        </div>
    </div>

    <!-- Overlay -->
    <div x-cloak
         x-show="open" 
         @click="open = false"
         x-transition:enter="transition-opacity ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-in duration-250"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black/40 backdrop-blur-sm z-40">
    </div>
    
    <!-- Estilos adicionales para x-cloak -->
    <style>
        [x-cloak] { display: none !important; }
    </style>
</nav>