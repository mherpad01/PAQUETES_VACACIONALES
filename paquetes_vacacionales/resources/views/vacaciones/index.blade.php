<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-4xl font-bold text-gray-900">
                    Explora Nuestros Destinos
                </h2>
                <p class="text-gray-600 mt-2">Descubre paquetes vacacionales excepcionales</p>
            </div>
            @auth
                @if(auth()->user()->canCreateVacaciones())
                    <a href="{{ route('vacaciones.create') }}" 
                       class="inline-flex items-center px-6 py-3 text-white font-bold shadow-md hover:shadow-lg transition-all duration-300 bg-gradient-to-r from-blue-600 to-blue-800">
                        <i class="fas fa-plus-circle mr-2"></i>
                        Crear Paquete
                    </a>
                @endif
            @endauth
        </div>
    </x-slot>

    <div class="py-8">
        <!-- Banner Informativo -->
        <div class="mb-8 bg-gradient-to-r from-blue-600 to-blue-800 shadow-lg p-10 text-white">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <h3 class="text-3xl font-bold mb-2">Encuentra Tu Destino Perfecto</h3>
                    <p class="text-blue-100 text-lg">Utiliza los filtros para personalizar tu búsqueda</p>
                </div>
                <div class="hidden lg:block">
                    <i class="fas fa-plane-departure text-8xl opacity-20"></i>
                </div>
            </div>
        </div>

        <!-- Filtros y Búsqueda -->
        <div class="mb-8">
            <div class="bg-white shadow-md p-8 border border-gray-200">
                <div class="flex items-center justify-between mb-8 pb-6 border-b border-gray-200">
                    <h3 class="text-2xl font-bold text-gray-900">
                        Filtros de Búsqueda
                    </h3>
                    <button @click="showFilters = !showFilters" 
                            class="lg:hidden px-4 py-2 bg-blue-100 text-blue-700 font-semibold hover:bg-blue-200 transition"
                            x-data="{ showFilters: true }">
                        <i class="fas fa-filter mr-2"></i>
                        <span x-text="showFilters ? 'Ocultar' : 'Mostrar'"></span>
                    </button>
                </div>

                <form method="GET" action="{{ route('vacaciones.index') }}" class="space-y-6" x-data="{ showFilters: true }">
                    <div x-show="showFilters" x-transition>
                        <!-- Primera fila: Búsqueda y Tipo -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">
                                    Buscar por título
                                </label>
                                <input type="text" 
                                       name="buscar" 
                                       value="{{ request('buscar') }}"
                                       placeholder="Ej: Playas del Caribe..."
                                       class="w-full px-4 py-3 border-2 border-gray-300 focus:border-blue-600 focus:ring-0 transition">
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">
                                    Tipo de viaje
                                </label>
                                <select name="tipo" 
                                        class="w-full px-4 py-3 border-2 border-gray-300 focus:border-blue-600 focus:ring-0 transition">
                                    <option value="">Todos los tipos</option>
                                    @foreach($tipos as $tipo)
                                        <option value="{{ $tipo->id }}" {{ request('tipo') == $tipo->id ? 'selected' : '' }}>
                                            {{ $tipo->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Segunda fila: País y Precio -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">
                                    País
                                </label>
                                <input type="text" 
                                       name="pais" 
                                       value="{{ request('pais') }}"
                                       placeholder="Ej: España, México..."
                                       class="w-full px-4 py-3 border-2 border-gray-300 focus:border-blue-600 focus:ring-0 transition">
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">
                                    Precio máximo
                                </label>
                                <input type="number" 
                                       name="precio_max" 
                                       value="{{ request('precio_max') }}"
                                       placeholder="Ej: 1000"
                                       min="0"
                                       step="50"
                                       class="w-full px-4 py-3 border-2 border-gray-300 focus:border-blue-600 focus:ring-0 transition">
                            </div>
                        </div>

                        <!-- Tercera fila: Ordenamiento -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">
                                    Ordenar por
                                </label>
                                <select name="order_by" 
                                        class="w-full px-4 py-3 border-2 border-gray-300 focus:border-blue-600 focus:ring-0 transition">
                                    <option value="created_at" {{ request('order_by') == 'created_at' ? 'selected' : '' }}>Fecha de creación</option>
                                    <option value="precio" {{ request('order_by') == 'precio' ? 'selected' : '' }}>Precio</option>
                                    <option value="titulo" {{ request('order_by') == 'titulo' ? 'selected' : '' }}>Título</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-3 uppercase tracking-wide">
                                    Dirección
                                </label>
                                <select name="order_dir" 
                                        class="w-full px-4 py-3 border-2 border-gray-300 focus:border-blue-600 focus:ring-0 transition">
                                    <option value="desc" {{ request('order_dir') == 'desc' ? 'selected' : '' }}>Descendente</option>
                                    <option value="asc" {{ request('order_dir') == 'asc' ? 'selected' : '' }}>Ascendente</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                        <button type="submit" 
                                class="flex-1 inline-flex items-center justify-center px-6 py-3 text-white font-bold shadow-md hover:shadow-lg transition-all duration-300 bg-gradient-to-r from-blue-600 to-blue-800">
                            <i class="fas fa-filter mr-2"></i>
                            Aplicar Filtros
                        </button>
                        <a href="{{ route('vacaciones.index') }}" 
                           class="flex-1 inline-flex items-center justify-center px-6 py-3 border-2 border-gray-300 text-gray-700 font-bold hover:bg-gray-50 transition-all duration-300">
                            <i class="fas fa-redo mr-2"></i>
                            Limpiar Filtros
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Filtros Activos -->
        @if(request()->hasAny(['buscar', 'tipo', 'pais', 'precio_max']))
            <div class="mb-8 bg-blue-50 p-5 border-l-4 border-blue-600">
                <div class="flex items-center justify-between">
                    <div class="flex items-center flex-wrap gap-3">
                        <span class="text-sm font-bold text-blue-900 uppercase tracking-wide">
                            Filtros activos:
                        </span>
                        @if(request('buscar'))
                            <span class="px-3 py-1 bg-blue-200 text-blue-900 text-sm font-semibold">
                                Búsqueda: "{{ request('buscar') }}"
                            </span>
                        @endif
                        @if(request('tipo'))
                            <span class="px-3 py-1 bg-blue-200 text-blue-900 text-sm font-semibold">
                                Tipo: {{ $tipos->find(request('tipo'))->nombre ?? 'N/A' }}
                            </span>
                        @endif
                        @if(request('pais'))
                            <span class="px-3 py-1 bg-blue-200 text-blue-900 text-sm font-semibold">
                                País: {{ request('pais') }}
                            </span>
                        @endif
                        @if(request('precio_max'))
                            <span class="px-3 py-1 bg-blue-200 text-blue-900 text-sm font-semibold">
                                Max: {{ request('precio_max') }}€
                            </span>
                        @endif
                    </div>
                    <a href="{{ route('vacaciones.index') }}" 
                       class="text-blue-700 hover:text-blue-900 font-bold text-sm">
                        Limpiar
                    </a>
                </div>
            </div>
        @endif

        <!-- Resultados -->
        <div class="mb-8 flex items-center justify-between">
            <p class="text-gray-600 text-lg">
                <span class="font-bold text-gray-900">{{ $vacaciones->total() }}</span> 
                {{ $vacaciones->total() == 1 ? 'paquete encontrado' : 'paquetes encontrados' }}
            </p>
        </div>

        @if($vacaciones->count() > 0)
            <!-- Grid de Paquetes -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-8">
                @foreach($vacaciones as $vacacion)
                    <article class="bg-white border border-gray-200 overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <!-- Imagen -->
                        <div class="relative h-64 overflow-hidden group">
                            <img src="{{ $vacacion->imagen_principal }}" 
                                 alt="{{ $vacacion->titulo }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            
                            <!-- Badge de tipo -->
                            <div class="absolute top-4 left-4">
                                <span class="px-3 py-1 bg-white text-blue-600 text-xs font-bold tracking-wide uppercase shadow-md">
                                    {{ $vacacion->tipo->nombre }}
                                </span>
                            </div>
                            
                            <!-- Precio -->
                            <div class="absolute top-4 right-4">
                                <div class="px-4 py-2 bg-white shadow-md">
                                    <span class="text-2xl font-bold text-gray-900">{{ number_format($vacacion->precio, 0) }}€</span>
                                </div>
                            </div>

                            <!-- Info del creador (hover) -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                                <div class="flex items-center text-white text-sm">
                                    <div class="w-8 h-8 bg-white/20 flex items-center justify-center mr-2">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <span class="font-semibold">{{ $vacacion->user->name }}</span>
                                    @if($vacacion->user->isAdmin())
                                        <span class="ml-2 px-2 py-0.5 bg-red-500 text-white text-xs uppercase">Admin</span>
                                    @elseif($vacacion->user->isAdvanced())
                                        <span class="ml-2 px-2 py-0.5 bg-amber-500 text-white text-xs uppercase">Advanced</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Contenido -->
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2 hover:text-blue-600 transition">
                                {{ $vacacion->titulo }}
                            </h3>

                            <div class="flex items-center text-gray-600 mb-4">
                                <i class="fas fa-map-marker-alt text-red-500 mr-2"></i>
                                <span class="font-semibold">{{ $vacacion->pais }}</span>
                            </div>

                            <p class="text-gray-600 mb-4 line-clamp-3 leading-relaxed">
                                {{ Str::limit($vacacion->descripcion, 100) }}
                            </p>

                            <div class="flex items-center justify-between mb-5 pt-4 border-t border-gray-100 text-sm text-gray-500">
                                @if($vacacion->fotos->count() > 0)
                                    <div class="flex items-center">
                                        <i class="fas fa-images mr-2 text-blue-500"></i>
                                        <span>{{ $vacacion->fotos->count() }} fotos</span>
                                    </div>
                                @endif
                                <div class="flex items-center">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>{{ $vacacion->created_at->diffForHumans() }}</span>
                                </div>
                            </div>

                            <a href="{{ route('vacaciones.show', $vacacion) }}" 
                               class="block w-full text-center px-6 py-3 border-2 border-blue-600 text-blue-600 font-bold hover:bg-blue-600 hover:text-white transition">
                                Ver Detalles
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Paginación -->
            <div class="bg-white shadow-md p-6 border border-gray-200">
                {{ $vacaciones->links() }}
            </div>
        @else
            <!-- Sin resultados -->
            <div class="bg-white shadow-md p-16 text-center border border-gray-200">
                <div class="w-24 h-24 mx-auto mb-6 bg-blue-50 flex items-center justify-center">
                    <i class="fas fa-search text-6xl text-blue-600"></i>
                </div>
                <h3 class="text-3xl font-bold text-gray-900 mb-3">No se encontraron paquetes</h3>
                <p class="text-gray-600 text-lg mb-8">
                    Intenta ajustar los filtros o realiza una búsqueda diferente
                </p>
                <a href="{{ route('vacaciones.index') }}" 
                   class="inline-flex items-center px-6 py-3 border-2 border-blue-600 text-blue-600 font-bold hover:bg-blue-600 hover:text-white transition">
                    <i class="fas fa-redo mr-2"></i>
                    Ver Todos los Paquetes
                </a>
            </div>
        @endif
    </div>
    <script>
        function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Cerrar modal al hacer clic fuera de él
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('fixed') && event.target.classList.contains('inset-0')) {
            event.target.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    });

    // Cerrar modal con tecla ESC
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            const modals = document.querySelectorAll('.fixed.inset-0');
            modals.forEach(modal => {
                if (!modal.classList.contains('hidden')) {
                    modal.classList.add('hidden');
                    document.body.style.overflow = 'auto';
                }
            });
        }
    });
    </script>
</x-app-layout>