<x-app-layout>
    <div class="py-8">
        <!-- Breadcrumb -->
        <div class="mb-6">
            <nav class="flex items-center text-sm text-gray-600">
                <a href="{{ route('vacaciones.index') }}" class="hover:text-blue-600 transition">
                    <i class="fas fa-home mr-1"></i>
                    Paquetes
                </a>
                <i class="fas fa-chevron-right mx-2 text-gray-400"></i>
                <span class="text-gray-900 font-semibold">{{ $vacacion->titulo }}</span>
            </nav>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Columna Principal -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Galería de Fotos -->
                <div class="bg-white shadow-lg overflow-hidden border border-gray-100">
                    @if($vacacion->fotos->count() > 0)
                        <div x-data="{ currentImage: 0, images: {{ $vacacion->fotos->pluck('url_completa')->toJson() }} }">
                            <!-- Imagen Principal -->
                            <div class="relative h-96 lg:h-[500px] bg-gray-900">
                                <template x-for="(image, index) in images" :key="index">
                                    <img x-show="currentImage === index"
                                         :src="image"
                                         alt="{{ $vacacion->titulo }}"
                                         class="w-full h-full object-cover"
                                         x-transition>
                                </template>

                                <!-- Controles -->
                                <button @click="currentImage = currentImage > 0 ? currentImage - 1 : images.length - 1"
                                        class="absolute left-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/90 backdrop-blur-sm flex items-center justify-center hover:bg-white transition shadow-lg">
                                    <i class="fas fa-chevron-left text-gray-900"></i>
                                </button>
                                <button @click="currentImage = currentImage < images.length - 1 ? currentImage + 1 : 0"
                                        class="absolute right-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/90 backdrop-blur-sm flex items-center justify-center hover:bg-white transition shadow-lg">
                                    <i class="fas fa-chevron-right text-gray-900"></i>
                                </button>

                                <!-- Contador -->
                                <div class="absolute bottom-4 right-4 px-4 py-2 bg-black/70 backdrop-blur-sm text-white text-sm font-semibold">
                                    <span x-text="currentImage + 1"></span> / <span x-text="images.length"></span>
                                </div>
                            </div>

                            <!-- Miniaturas -->
                            <div class="p-4 bg-gray-50 flex gap-2 overflow-x-auto">
                                <template x-for="(image, index) in images" :key="index">
                                    <button @click="currentImage = index"
                                            :class="currentImage === index ? 'ring-4 ring-blue-600' : 'ring-2 ring-gray-200'"
                                            class="flex-shrink-0 w-24 h-24 overflow-hidden transition">
                                        <img :src="image" 
                                             alt="Miniatura"
                                             class="w-full h-full object-cover">
                                    </button>
                                </template>
                            </div>
                        </div>
                    @else
                        <div class="h-96 bg-gray-100 flex items-center justify-center">
                            <div class="text-center text-gray-400">
                                <i class="fas fa-image text-6xl mb-4"></i>
                                <p class="text-lg">Sin imágenes disponibles</p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Información del Paquete -->
                <div class="bg-white shadow-lg p-8 border border-gray-100">
                    <div class="flex items-start justify-between mb-6">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-4">
                                <span class="px-4 py-2 bg-blue-50 text-blue-700 text-sm font-bold tracking-wide uppercase">
                                    {{ $vacacion->tipo->nombre }}
                                </span>
                                <span class="px-4 py-2 bg-red-50 text-red-700 text-sm font-bold">
                                    <i class="fas fa-map-marker-alt mr-1"></i>
                                    {{ $vacacion->pais }}
                                </span>
                            </div>
                            <h1 class="text-4xl font-bold text-gray-900 mb-3">
                                {{ $vacacion->titulo }}
                            </h1>
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-user mr-2"></i>
                                <span>Creado por <strong>{{ $vacacion->user->name }}</strong></span>
                                @if($vacacion->user->isAdmin())
                                    <span class="ml-2 px-3 py-1 bg-red-100 text-red-700 text-xs font-bold tracking-wide uppercase">
                                        <i class="fas fa-crown mr-1"></i>ADMIN
                                    </span>
                                @elseif($vacacion->user->isAdvanced())
                                    <span class="ml-2 px-3 py-1 bg-yellow-100 text-yellow-700 text-xs font-bold tracking-wide uppercase">
                                        <i class="fas fa-star mr-1"></i>ADVANCED
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="section-divider my-6"></div>

                    <!-- Descripción -->
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Descripción</h2>
                        <p class="text-gray-700 leading-relaxed whitespace-pre-line text-lg">{{ $vacacion->descripcion }}</p>
                    </div>

                    <!-- Botones de Acción -->
@auth
    @php
        $user = auth()->user();
        $canModify = $user->isAdmin() || ($user->isAdvanced() && $vacacion->user_id === $user->id);
    @endphp

    @if($canModify)
        <div class="flex gap-3 pt-6 border-t-2 border-gray-200">
            <a href="{{ route('vacaciones.edit', $vacacion) }}" 
               class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-yellow-500 text-white font-bold hover:bg-yellow-600 transition shadow-md">
                <i class="fas fa-edit mr-2"></i>
                Editar Paquete
            </a>
            <button onclick="openModal('delete-vacacion-modal')"
                    class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-red-500 text-white font-bold hover:bg-red-600 transition shadow-md">
                <i class="fas fa-trash mr-2"></i>
                Eliminar Paquete
            </button>
        </div>

        <!-- Modal para ELIMINAR paquete -->
<div id="delete-vacacion-modal" class="hidden fixed inset-0 z-50 overflow-y-auto" style="background-color: rgba(0, 0, 0, 0.5);">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-red-100 flex items-center justify-center mr-4 rounded">
                        <i class="fas fa-exclamation-triangle text-2xl text-red-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Eliminar Paquete Vacacional</h3>
                </div>
                
                @if($vacacion->reservas()->count() > 0)
                    <!-- Si HAY reservas activas -->
                    <div class="bg-red-50 border-2 border-red-300 p-6 mb-6 rounded">
                        <div class="flex items-start mb-3">
                            <i class="fas fa-ban text-3xl text-red-600 mr-4 mt-1"></i>
                            <div>
                                <h4 class="text-lg font-bold text-red-900 mb-2">No se puede eliminar este paquete</h4>
                                <p class="text-red-800 mb-3">
                                    Este paquete tiene <strong>{{ $vacacion->reservas()->count() }} reserva(s) activa(s)</strong> de los siguientes usuarios:
                                </p>
                                <ul class="ml-4 space-y-1">
                                    @foreach($vacacion->reservas as $reserva)
                                        <li class="text-sm text-red-700">
                                            <i class="fas fa-user mr-2"></i>{{ $reserva->user->name }} 
                                            <span class="text-xs">({{ $reserva->created_at->diffForHumans() }})</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <p class="text-sm text-red-800 font-semibold mt-4">
                            <i class="fas fa-info-circle mr-2"></i>
                            Para eliminar este paquete, primero todas las reservas deben ser canceladas.
                        </p>
                    </div>

                    <div class="flex justify-end">
                        <button type="button"
                                onclick="closeModal('delete-vacacion-modal')"
                                class="px-6 py-2 bg-gray-600 text-white font-semibold hover:bg-gray-700 transition">
                            Cerrar
                        </button>
                    </div>
                @else
                    <!-- Si NO hay reservas activas -->
                    <p class="text-gray-700 mb-4">
                        ¿Estás seguro de que deseas eliminar el paquete <strong>"{{ $vacacion->titulo }}"</strong>?
                    </p>

                    <div class="bg-yellow-50 border border-yellow-200 p-4 mb-6 rounded">
                        <p class="text-sm text-yellow-800">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            <strong>Advertencia:</strong> Esta acción eliminará permanentemente:
                        </p>
                        <ul class="mt-2 ml-6 text-sm text-yellow-800 list-disc">
                            <li>El paquete vacacional</li>
                            <li>Todas las fotos asociadas ({{ $vacacion->fotos->count() }})</li>
                            <li>Todos los comentarios ({{ $vacacion->comentarios->count() }})</li>
                        </ul>
                        <p class="mt-2 text-sm text-yellow-800 font-semibold">
                            Esta acción NO se puede deshacer.
                        </p>
                    </div>

                    <form action="{{ route('vacaciones.destroy', $vacacion) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="flex justify-end gap-3">
                            <button type="button"
                                    onclick="closeModal('delete-vacacion-modal')"
                                    class="px-6 py-2 border-2 border-gray-300 font-semibold text-gray-700 hover:bg-gray-50 transition">
                                Cancelar
                            </button>
                            <button type="submit" 
                                    class="px-6 py-2 bg-red-600 text-white font-semibold hover:bg-red-700 transition">
                                <i class="fas fa-trash mr-2"></i>
                                Sí, Eliminar Permanentemente
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
    @endif
@endauth
                
                <!-- Comentarios -->
<div class="bg-white shadow-lg p-8 border border-gray-100">
    <h2 class="text-3xl font-bold text-gray-900 mb-8">
        Comentarios ({{ $vacacion->comentarios->count() }})
    </h2>

    <!-- Formulario para agregar comentario -->
    @auth
        @if($tieneReserva)
            <div class="mb-8 p-6 bg-blue-50 border-2 border-blue-200">
                <h3 class="font-bold text-gray-900 mb-4 text-lg">Escribe tu opinión</h3>
                <form action="{{ route('comentarios.store', $vacacion) }}" method="POST">
                    @csrf
                    <textarea name="texto" 
                              rows="4" 
                              placeholder="Comparte tu experiencia con este paquete..."
                              class="w-full px-4 py-3 border-2 border-blue-200 focus:border-blue-600 focus:ring-2 focus:ring-blue-200 transition resize-none"
                              required></textarea>
                    <button type="submit" 
                            class="mt-4 inline-flex items-center px-6 py-3 text-white font-bold shadow-md hover:shadow-lg transition"
                            style="background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%);">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Publicar Comentario
                    </button>
                </form>
            </div>
        @else
            <div class="mb-8 p-6 bg-yellow-50 border-2 border-yellow-200">
                <p class="text-gray-700 flex items-center">
                    <i class="fas fa-info-circle mr-2 text-yellow-600"></i>
                    <span>Debes reservar este paquete para poder comentar</span>
                </p>
            </div>
        @endif
    @else
        <div class="mb-8 p-6 bg-gray-50 border-2 border-gray-200">
            <p class="text-gray-700 flex items-center">
                <i class="fas fa-sign-in-alt mr-2"></i>
                <span><a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:underline">Inicia sesión</a> para comentar</span>
            </p>
        </div>
    @endauth

    <!-- Lista de Comentarios -->
    @if($vacacion->comentarios->count() > 0)
        <div class="space-y-6">
            @foreach($vacacion->comentarios as $comentario)
                <div class="p-6 bg-gray-50 border border-gray-200">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center text-white font-bold text-lg">
                                {{ strtoupper(substr($comentario->user->name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-bold text-gray-900">{{ $comentario->user->name }}</p>
                                <p class="text-sm text-gray-500">{{ $comentario->created_at->diffForHumans() }}</p>
                            </div>
                        </div>

                        @auth
                            @if(auth()->id() === $comentario->id_user)
                                <div class="flex gap-2">
                                    <button onclick="openModal('edit-comment-modal-{{ $comentario->id }}')"
                                            class="px-3 py-1 bg-yellow-100 text-yellow-700 text-sm font-semibold hover:bg-yellow-200 transition">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="openModal('delete-comment-modal-{{ $comentario->id }}')"
                                            class="px-3 py-1 bg-red-100 text-red-700 text-sm font-semibold hover:bg-red-200 transition">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            @endif
                        @endauth
                    </div>

                    <p class="text-gray-700 leading-relaxed">{{ $comentario->texto }}</p>
                </div>

                @auth
                    @if(auth()->id() === $comentario->id_user)
                        <!-- Modal para EDITAR comentario -->
                        <div id="edit-comment-modal-{{ $comentario->id }}" class="hidden fixed inset-0 z-50 overflow-y-auto" style="background-color: rgba(0, 0, 0, 0.5);">
                            <div class="flex items-center justify-center min-h-screen px-4">
                                <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full">
                                    <div class="p-6">
                                        <h3 class="text-xl font-bold mb-4">Editar Comentario</h3>
                                        <form action="{{ route('comentarios.update', $comentario) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <textarea name="texto" 
                                                      rows="4" 
                                                      class="w-full px-4 py-3 border-2 border-gray-200 focus:border-blue-600 focus:ring-2 focus:ring-blue-200 transition resize-none"
                                                      required>{{ $comentario->texto }}</textarea>
                                            <div class="mt-4 flex justify-end gap-3">
                                                <button type="button"
                                                        onclick="closeModal('edit-comment-modal-{{ $comentario->id }}')"
                                                        class="px-6 py-2 border-2 border-gray-300 font-semibold text-gray-700 hover:bg-gray-50 transition">
                                                    Cancelar
                                                </button>
                                                <button type="submit" 
                                                        class="px-6 py-2 bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">
                                                    Guardar Cambios
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal para ELIMINAR comentario -->
                        <div id="delete-comment-modal-{{ $comentario->id }}" class="hidden fixed inset-0 z-50 overflow-y-auto" style="background-color: rgba(0, 0, 0, 0.5);">
                            <div class="flex items-center justify-center min-h-screen px-4">
                                <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full">
                                    <div class="p-6">
                                        <div class="flex items-center mb-4">
                                            <div class="w-12 h-12 bg-red-100 flex items-center justify-center mr-4 rounded">
                                                <i class="fas fa-exclamation-triangle text-2xl text-red-600"></i>
                                            </div>
                                            <h3 class="text-xl font-bold text-gray-900">Eliminar Comentario</h3>
                                        </div>
                                        
                                        <p class="text-gray-700 mb-6">
                                            ¿Estás seguro de que deseas eliminar este comentario? Esta acción no se puede deshacer.
                                        </p>

                                        <div class="bg-gray-50 p-4 border border-gray-200 mb-6 rounded">
                                            <p class="text-sm text-gray-600 italic">
                                                "{{ Str::limit($comentario->texto, 100) }}"
                                            </p>
                                        </div>

                                        <form action="{{ route('comentarios.destroy', $comentario) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="flex justify-end gap-3">
                                                <button type="button"
                                                        onclick="closeModal('delete-comment-modal-{{ $comentario->id }}')"
                                                        class="px-6 py-2 border-2 border-gray-300 font-semibold text-gray-700 hover:bg-gray-50 transition">
                                                    Cancelar
                                                </button>
                                                <button type="submit" 
                                                        class="px-6 py-2 bg-red-600 text-white font-semibold hover:bg-red-700 transition">
                                                    <i class="fas fa-trash mr-2"></i>
                                                    Eliminar Comentario
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endauth
            @endforeach
        </div>
    @else
        <div class="text-center py-12 text-gray-500">
            <i class="fas fa-comment-slash text-5xl mb-4"></i>
            <p class="text-lg">Aún no hay comentarios. ¡Sé el primero en opinar!</p>
        </div>
    @endif
</div>


            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="sticky top-24 space-y-6">
                    <!-- Card de Precio y Reserva -->
                    <div class="bg-white shadow-lg p-8 border border-gray-100">
                        <div class="text-center mb-8">
                            <p class="text-gray-600 mb-1">Precio por persona</p>
                            <div class="text-6xl font-bold text-gray-900 mb-2">
                                {{ number_format($vacacion->precio, 0) }}€
                            </div>
                            <p class="text-gray-500">IVA incluido</p>
                        </div>

                        @auth
                            @if($tieneReserva)
                                <div class="mb-4 p-4 bg-green-50 border-2 border-green-200">
                                    <p class="text-green-800 font-semibold text-center flex items-center justify-center">
                                        <i class="fas fa-check-circle mr-2"></i>
                                        Ya tienes este paquete reservado
                                    </p>
                                </div>
                                <form action="{{ route('reservas.destroy', $vacacion) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="w-full px-6 py-4 bg-red-500 text-white font-bold text-lg hover:bg-red-600 transition shadow-md"
                                            onclick="return confirm('¿Estás seguro de cancelar tu reserva?');">
                                        <i class="fas fa-times-circle mr-2"></i>
                                        Cancelar Reserva
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('reservas.store', $vacacion) }}" method="POST">
                                    @csrf
                                    <button type="submit" 
                                            class="w-full px-6 py-4 text-white font-bold text-lg shadow-lg hover:shadow-xl transition-all duration-300"
                                            style="background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%);">
                                        <i class="fas fa-calendar-check mr-2"></i>
                                        Reservar Ahora
                                    </button>
                                </form>
                            @endif
                        @else
                            <a href="{{ route('login') }}" 
                               class="block w-full px-6 py-4 text-center text-white font-bold text-lg shadow-lg hover:shadow-xl transition"
                               style="background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%);">
                                <i class="fas fa-sign-in-alt mr-2"></i>
                                Inicia Sesión para Reservar
                            </a>
                        @endauth

                        <div class="mt-6 pt-6 border-t space-y-4">
                            <div class="flex items-center text-gray-700">
                                <i class="fas fa-shield-check text-green-600 mr-3 text-xl"></i>
                                <span>Cancelación gratuita</span>
                            </div>
                            <div class="flex items-center text-gray-700">
                                <i class="fas fa-headset text-blue-600 mr-3 text-xl"></i>
                                <span>Soporte 24/7</span>
                            </div>
                            <div class="flex items-center text-gray-700">
                                <i class="fas fa-medal text-yellow-600 mr-3 text-xl"></i>
                                <span>Mejor precio garantizado</span>
                            </div>
                        </div>
                    </div>

                    <!-- Información Adicional -->
                    <div class="bg-white shadow-lg p-6 border border-gray-100">
                        <h3 class="font-bold text-gray-900 mb-4 text-lg">Información del Viaje</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between py-3 border-b border-gray-200">
                                <span class="text-gray-600">Destino:</span>
                                <span class="font-semibold text-gray-900">{{ $vacacion->pais }}</span>
                            </div>
                            <div class="flex justify-between py-3 border-b border-gray-200">
                                <span class="text-gray-600">Tipo:</span>
                                <span class="font-semibold text-gray-900">{{ $vacacion->tipo->nombre }}</span>
                            </div>
                            <div class="flex justify-between py-3 border-b border-gray-200">
                                <span class="text-gray-600">Fotos:</span>
                                <span class="font-semibold text-gray-900">{{ $vacacion->fotos->count() }}</span>
                            </div>
                            <div class="flex justify-between py-3">
                                <span class="text-gray-600">Publicado:</span>
                                <span class="font-semibold text-gray-900">{{ $vacacion->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Compartir -->
                    <div class="bg-white shadow-lg p-6 border border-gray-100">
                        <h3 class="font-bold text-gray-900 mb-4 text-lg">Compartir</h3>
                        <div class="flex gap-2">
                            <a href="#" class="flex-1 px-4 py-3 bg-blue-600 text-white text-center hover:bg-blue-700 transition">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="flex-1 px-4 py-3 bg-sky-500 text-white text-center hover:bg-sky-600 transition">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="flex-1 px-4 py-3 bg-green-600 text-white text-center hover:bg-green-700 transition">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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