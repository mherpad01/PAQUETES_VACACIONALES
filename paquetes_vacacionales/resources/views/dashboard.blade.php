<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-1">
                    Dashboard
                </h2>
                <p class="text-sm text-gray-600">
                    Bienvenido de nuevo, <span class="font-semibold text-blue-700">{{ Auth::user()->name }}</span>
                </p>
            </div>
            <div class="flex items-center gap-2">
                @if(Auth::user()->isAdmin())
                    <span class="px-3 py-1.5 rounded-full text-xs font-semibold bg-red-50 border border-red-200 text-red-700">
                        <i class="fas fa-crown mr-1"></i>Administrador
                    </span>
                @elseif(Auth::user()->isAdvanced())
                    <span class="px-3 py-1.5 rounded-full text-xs font-semibold bg-amber-50 border border-amber-200 text-amber-700">
                        <i class="fas fa-star mr-1"></i>Usuario Avanzado
                    </span>
                @else
                    <span class="px-3 py-1.5 rounded-full text-xs font-semibold bg-blue-50 border border-blue-200 text-blue-700">
                        <i class="fas fa-user mr-1"></i>Usuario
                    </span>
                @endif
            </div>
        </div>
    </x-slot>

    <!-- Estadísticas Principales -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Reservas -->
        <div class="bg-white border border-gray-200 shadow-sm hover:shadow-md transition-shadow duration-300">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-blue-50 flex items-center justify-center">
                        <i class="fas fa-suitcase text-xl text-blue-600"></i>
                    </div>
                    <span class="text-xs font-semibold text-blue-600 bg-blue-50 px-2.5 py-1">
                        Activas
                    </span>
                </div>
                <p class="text-3xl font-bold text-gray-900 mb-1">
                    {{ Auth::user()->reservas->count() }}
                </p>
                <p class="text-sm text-gray-600 mb-3">Reservas totales</p>
                <a href="{{ route('reservas.mis-reservas') }}" 
                   class="inline-flex items-center text-sm text-blue-600 font-medium hover:text-blue-700 transition-colors">
                    Ver todas 
                    <i class="fas fa-arrow-right ml-1.5 text-xs"></i>
                </a>
            </div>
        </div>

        <!-- Comentarios -->
        <div class="bg-white border border-gray-200 shadow-sm hover:shadow-md transition-shadow duration-300">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-purple-50 flex items-center justify-center">
                        <i class="fas fa-comments text-xl text-purple-600"></i>
                    </div>
                    <span class="text-xs font-semibold text-purple-600 bg-purple-50 px-2.5 py-1">
                        Opiniones
                    </span>
                </div>
                <p class="text-3xl font-bold text-gray-900 mb-1">
                    {{ Auth::user()->comentarios->count() }}
                </p>
                <p class="text-sm text-gray-600 mb-3">Comentarios escritos</p>
                <span class="text-sm text-gray-400 font-medium">Total publicado</span>
            </div>
        </div>

        <!-- Paquetes Creados (si es Admin o Advanced) -->
        @if(Auth::user()->canCreateVacaciones())
            <div class="bg-white border border-gray-200 shadow-sm hover:shadow-md transition-shadow duration-300">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-amber-50 flex items-center justify-center">
                            <i class="fas fa-globe-americas text-xl text-amber-600"></i>
                        </div>
                        <span class="text-xs font-semibold text-amber-600 bg-amber-50 px-2.5 py-1">
                            Creados
                        </span>
                    </div>
                    <p class="text-3xl font-bold text-gray-900 mb-1">
                        {{ Auth::user()->vacaciones->count() }}
                    </p>
                    <p class="text-sm text-gray-600 mb-3">Paquetes publicados</p>
                    <a href="{{ route('vacaciones.create') }}" 
                       class="inline-flex items-center text-sm text-amber-600 font-medium hover:text-amber-700 transition-colors">
                        Crear nuevo 
                        <i class="fas fa-plus ml-1.5 text-xs"></i>
                    </a>
                </div>
            </div>
        @endif

        <!-- Inversión Total -->
        <div class="bg-white border border-gray-200 shadow-sm hover:shadow-md transition-shadow duration-300">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-emerald-50 flex items-center justify-center">
                        <i class="fas fa-euro-sign text-xl text-emerald-600"></i>
                    </div>
                    <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-2.5 py-1">
                        Total
                    </span>
                </div>
                <p class="text-3xl font-bold text-gray-900 mb-1">
                    {{ number_format(Auth::user()->reservas->sum(fn($r) => $r->vacacion->precio), 0) }}€
                </p>
                <p class="text-sm text-gray-600 mb-3">Inversión en viajes</p>
                <span class="text-sm text-gray-400 font-medium">Gasto acumulado</span>
            </div>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Columna Principal -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Mis Reservas Recientes -->
            <div class="bg-white border border-gray-200 shadow-sm">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-bold text-gray-900 flex items-center">
                            <i class="fas fa-bookmark text-blue-600 mr-2"></i>
                            Mis Últimas Reservas
                        </h3>
                        <a href="{{ route('reservas.mis-reservas') }}" 
                           class="text-sm text-blue-600 font-medium hover:text-blue-700 transition-colors flex items-center">
                            Ver todas 
                            <i class="fas fa-arrow-right ml-1.5 text-xs"></i>
                        </a>
                    </div>
                </div>

                <div class="p-6">
                    @if(Auth::user()->reservas->count() > 0)
                        <div class="space-y-4">
                            @foreach(Auth::user()->reservas->take(3) as $reserva)
                                <article class="border border-gray-200 hover:border-gray-300 hover:shadow-sm transition-all duration-300 overflow-hidden group">
                                    <div class="flex flex-col sm:flex-row gap-4 p-4">
                                        <div class="relative w-full sm:w-28 h-28 flex-shrink-0 overflow-hidden">
                                            <img src="{{ $reserva->vacacion->imagen_principal }}" 
                                                 alt="{{ $reserva->vacacion->titulo }}"
                                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                            <div class="absolute top-2 right-2">
                                                <span class="px-2 py-1 bg-white/90 backdrop-blur-sm text-xs font-semibold shadow-sm">
                                                    {{ $reserva->vacacion->tipo->nombre }}
                                                </span>
                                            </div>
                                        </div>
                                        
                                        <div class="flex-1 flex flex-col justify-between min-w-0">
                                            <div>
                                                <h4 class="text-base font-bold text-gray-900 mb-2 hover:text-blue-600 transition-colors truncate">
                                                    {{ $reserva->vacacion->titulo }}
                                                </h4>
                                                <p class="text-sm text-gray-600 flex items-center mb-2">
                                                    <i class="fas fa-map-marker-alt text-red-500 mr-2 text-xs"></i>
                                                    <span class="font-medium">{{ $reserva->vacacion->pais }}</span>
                                                </p>
                                                <p class="text-xs text-gray-500 flex items-center">
                                                    <i class="fas fa-clock mr-1.5"></i>
                                                    Reservado {{ $reserva->created_at->diffForHumans() }}
                                                </p>
                                            </div>
                                        </div>

                                        <div class="flex flex-col items-end justify-between sm:text-right border-t sm:border-t-0 sm:border-l border-gray-200 pt-4 sm:pt-0 sm:pl-4">
                                            <div class="mb-3">
                                                <p class="text-2xl font-bold text-gray-900">
                                                    {{ number_format($reserva->vacacion->precio, 0) }}€
                                                </p>
                                                <p class="text-xs text-gray-500">Precio total</p>
                                            </div>
                                            <a href="{{ route('vacaciones.show', $reserva->vacacion) }}" 
                                               class="px-4 py-2 border border-blue-600 text-blue-600 text-sm font-medium hover:bg-blue-600 hover:text-white transition-all duration-300">
                                                Ver Detalles
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-16">
                            <div class="w-20 h-20 mx-auto mb-4 bg-blue-50 flex items-center justify-center">
                                <i class="fas fa-suitcase text-4xl text-blue-600"></i>
                            </div>
                            <h4 class="text-lg font-bold text-gray-900 mb-2">Aún no tienes reservas</h4>
                            <p class="text-sm text-gray-600 mb-5 max-w-md mx-auto leading-relaxed">
                                Descubre destinos increíbles y comienza tu aventura
                            </p>
                            <a href="{{ route('vacaciones.index') }}" 
                               class="inline-flex items-center px-5 py-2.5 bg-blue-600 text-white font-medium hover:bg-blue-700 transition-colors shadow-sm hover:shadow-md">
                                Explorar Paquetes
                                <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Mis Paquetes Creados (si es Admin o Advanced) -->
            @if(Auth::user()->canCreateVacaciones())
                <div class="bg-white border border-gray-200 shadow-sm">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-bold text-gray-900 flex items-center">
                                <i class="fas fa-globe-americas text-amber-600 mr-2"></i>
                                Mis Paquetes Creados
                            </h3>
                            <a href="{{ route('vacaciones.create') }}" 
                               class="text-sm text-amber-600 font-medium hover:text-amber-700 transition-colors flex items-center">
                                Crear nuevo 
                                <i class="fas fa-plus ml-1.5 text-xs"></i>
                            </a>
                        </div>
                    </div>

                    <div class="p-6">
                        @if(Auth::user()->vacaciones->count() > 0)
                            <div class="space-y-4">
                                @foreach(Auth::user()->vacaciones->take(3) as $vacacion)
                                    <article class="border border-gray-200 hover:border-gray-300 hover:shadow-sm transition-all duration-300 overflow-hidden group">
                                        <div class="flex flex-col sm:flex-row gap-4 p-4">
                                            <div class="relative w-full sm:w-28 h-28 flex-shrink-0 overflow-hidden">
                                                <img src="{{ $vacacion->imagen_principal }}" 
                                                     alt="{{ $vacacion->titulo }}"
                                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                            </div>
                                            
                                            <div class="flex-1 flex flex-col justify-between min-w-0">
                                                <div>
                                                    <h4 class="text-base font-bold text-gray-900 mb-2 hover:text-amber-600 transition-colors truncate">
                                                        {{ $vacacion->titulo }}
                                                    </h4>
                                                    <div class="flex flex-wrap items-center gap-3 text-sm text-gray-600 mb-2">
                                                        <span class="flex items-center">
                                                            <i class="fas fa-bookmark text-blue-500 mr-1.5 text-xs"></i>
                                                            <span class="font-medium">{{ $vacacion->reservas->count() }} reservas</span>
                                                        </span>
                                                        <span class="flex items-center">
                                                            <i class="fas fa-comments text-purple-500 mr-1.5 text-xs"></i>
                                                            <span class="font-medium">{{ $vacacion->comentarios->count() }} comentarios</span>
                                                        </span>
                                                    </div>
                                                    <p class="text-xs text-gray-500 flex items-center">
                                                        <i class="fas fa-clock mr-1.5"></i>
                                                        Creado {{ $vacacion->created_at->diffForHumans() }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="flex gap-2 items-start border-t sm:border-t-0 sm:border-l border-gray-200 pt-4 sm:pt-0 sm:pl-4">
                                                <a href="{{ route('vacaciones.edit', $vacacion) }}" 
                                                   class="p-2.5 bg-amber-50 text-amber-600 hover:bg-amber-100 transition-colors">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route('vacaciones.show', $vacacion) }}" 
                                                   class="p-2.5 bg-blue-50 text-blue-600 hover:bg-blue-100 transition-colors">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-16">
                                <div class="w-20 h-20 mx-auto mb-4 bg-amber-50 flex items-center justify-center">
                                    <i class="fas fa-globe-americas text-4xl text-amber-600"></i>
                                </div>
                                <h4 class="text-lg font-bold text-gray-900 mb-2">Aún no has creado paquetes</h4>
                                <p class="text-sm text-gray-600 mb-5 max-w-md mx-auto leading-relaxed">
                                    Comparte tus destinos favoritos con la comunidad
                                </p>
                                <a href="{{ route('vacaciones.create') }}" 
                                   class="inline-flex items-center px-5 py-2.5 bg-amber-600 text-white font-medium hover:bg-amber-700 transition-colors shadow-sm hover:shadow-md">
                                    Crear Primer Paquete
                                    <i class="fas fa-plus ml-2"></i>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Mis Comentarios Recientes -->
            <div class="bg-white border border-gray-200 shadow-sm">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center">
                        <i class="fas fa-comments text-purple-600 mr-2"></i>
                        Mis Comentarios Recientes
                    </h3>
                </div>

                <div class="p-6">
                    @if(Auth::user()->comentarios->count() > 0)
                        <div class="space-y-3">
                            @foreach(Auth::user()->comentarios->take(3) as $comentario)
                                <div class="border border-gray-200 p-4 hover:border-gray-300 hover:shadow-sm transition-all duration-300">
                                    <div class="flex items-start justify-between mb-2">
                                        <a href="{{ route('vacaciones.show', $comentario->vacacion) }}" 
                                           class="font-semibold text-gray-900 hover:text-purple-600 transition-colors flex-1 text-sm">
                                            {{ $comentario->vacacion->titulo }}
                                        </a>
                                        <span class="text-xs text-gray-500 ml-3 flex-shrink-0">
                                            <i class="fas fa-clock mr-1"></i>
                                            {{ $comentario->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-700 leading-relaxed">
                                        {{ Str::limit($comentario->texto, 120) }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-16">
                            <div class="w-20 h-20 mx-auto mb-4 bg-purple-50 flex items-center justify-center">
                                <i class="fas fa-comment-slash text-4xl text-purple-600"></i>
                            </div>
                            <h4 class="text-lg font-bold text-gray-900 mb-2">Aún no has escrito comentarios</h4>
                            <p class="text-sm text-gray-600 max-w-md mx-auto leading-relaxed">
                                Reserva un paquete para poder compartir tu experiencia
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Información del Usuario -->
            <div class="bg-white border border-gray-200 shadow-sm overflow-hidden">
                <div class="p-6 text-center bg-gradient-to-br from-gray-50 to-white border-b border-gray-200">
                    <div class="w-20 h-20 mx-auto mb-3 bg-gradient-to-br from-blue-600 to-blue-700 rounded-full flex items-center justify-center text-white text-xl font-bold shadow-sm">
                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-1">{{ Auth::user()->name }}</h3>
                    <p class="text-sm text-gray-600 mb-4">{{ Auth::user()->email }}</p>
                    
                    <div class="mb-5">
                        @if(Auth::user()->isAdmin())
                            <span class="px-3 py-1.5 text-xs font-semibold bg-red-50 border border-red-200 text-red-700 inline-block">
                                <i class="fas fa-crown mr-1"></i>Administrador
                            </span>
                        @elseif(Auth::user()->isAdvanced())
                            <span class="px-3 py-1.5 text-xs font-semibold bg-amber-50 border border-amber-200 text-amber-700 inline-block">
                                <i class="fas fa-star mr-1"></i>Usuario Avanzado
                            </span>
                        @else
                            <span class="px-3 py-1.5 text-xs font-semibold bg-blue-50 border border-blue-200 text-blue-700 inline-block">
                                <i class="fas fa-user mr-1"></i>Usuario
                            </span>
                        @endif
                    </div>
                </div>

                <div class="p-4 space-y-2">
                    <a href="{{ route('profile.edit') }}" 
                       class="block w-full px-4 py-2.5 border border-blue-600 text-blue-600 text-center font-medium hover:bg-blue-600 hover:text-white transition-all duration-300 text-sm">
                        <i class="fas fa-user-edit mr-2"></i>
                        Editar Perfil
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" 
                                class="block w-full px-4 py-2.5 bg-gray-100 text-gray-700 text-center font-medium hover:bg-gray-200 transition-all duration-300 text-sm">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            Cerrar Sesión
                        </button>
                    </form>
                </div>
            </div>

            <!-- Acceso Rápido -->
            <div class="bg-white border border-gray-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-base font-bold text-gray-900 flex items-center">
                        <i class="fas fa-bolt text-amber-500 mr-2"></i>
                        Acceso Rápido
                    </h3>
                </div>
                <div class="p-4">
                    <div class="space-y-2">
                        <a href="{{ route('vacaciones.index') }}" 
                           class="flex items-center p-3 border border-gray-200 hover:border-blue-300 hover:bg-blue-50 transition-all duration-300 text-gray-700">
                            <div class="w-9 h-9 bg-blue-50 flex items-center justify-center mr-3 flex-shrink-0">
                                <i class="fas fa-search text-blue-600"></i>
                            </div>
                            <span class="font-medium text-sm">Explorar Paquetes</span>
                        </a>
                        <a href="{{ route('reservas.mis-reservas') }}" 
                           class="flex items-center p-3 border border-gray-200 hover:border-purple-300 hover:bg-purple-50 transition-all duration-300 text-gray-700">
                            <div class="w-9 h-9 bg-purple-50 flex items-center justify-center mr-3 flex-shrink-0">
                                <i class="fas fa-bookmark text-purple-600"></i>
                            </div>
                            <span class="font-medium text-sm">Mis Reservas</span>
                        </a>
                        @if(Auth::user()->canCreateVacaciones())
                            <a href="{{ route('vacaciones.create') }}" 
                               class="flex items-center p-3 border border-gray-200 hover:border-green-300 hover:bg-green-50 transition-all duration-300 text-gray-700">
                                <div class="w-9 h-9 bg-green-50 flex items-center justify-center mr-3 flex-shrink-0">
                                    <i class="fas fa-plus-circle text-green-600"></i>
                                </div>
                                <span class="font-medium text-sm">Crear Paquete</span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Consejo del Día -->
            <div class="bg-gradient-to-br from-blue-600 to-blue-700 shadow-sm overflow-hidden">
                <div class="p-6 text-white">
                    <h3 class="text-base font-bold mb-2 flex items-center">
                        <i class="fas fa-lightbulb mr-2"></i>
                        Consejo del Día
                    </h3>
                    <p class="text-sm text-blue-100 mb-4 leading-relaxed">
                        ¡Reserva tus paquetes favoritos ahora! Los mejores destinos se agotan rápido.
                    </p>
                    <a href="{{ route('vacaciones.index') }}" 
                       class="inline-flex items-center text-sm font-medium hover:underline bg-white/20 px-4 py-2 hover:bg-white/30 transition-all duration-300">
                        Ver paquetes disponibles 
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>