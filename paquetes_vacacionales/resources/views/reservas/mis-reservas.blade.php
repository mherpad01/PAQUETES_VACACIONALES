<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-suitcase text-blue-600 mr-3"></i>
                    Mis Reservas
                </h2>
                <p class="text-gray-600 mt-2">Gestiona todos tus paquetes vacacionales reservados</p>
            </div>
            <a href="{{ route('vacaciones.index') }}" 
               class="inline-flex items-center px-6 py-3 text-white font-bold shadow-lg hover:shadow-xl transition-all duration-300"
               style="background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%);">
                <i class="fas fa-plus-circle mr-2"></i>
                Explorar Más Paquetes
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        @if($reservas->count() > 0)
            <!-- Estadísticas Rápidas -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white shadow-lg p-6 border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 font-semibold mb-1">Total Reservas</p>
                            <p class="text-4xl font-bold text-gray-900">{{ $reservas->count() }}</p>
                        </div>
                        <div class="w-16 h-16 bg-blue-50 flex items-center justify-center">
                            <i class="fas fa-bookmark text-3xl text-blue-600"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow-lg p-6 border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 font-semibold mb-1">Inversión Total</p>
                            <p class="text-4xl font-bold text-gray-900">{{ number_format($reservas->sum(fn($r) => $r->vacacion->precio), 0) }}€</p>
                        </div>
                        <div class="w-16 h-16 bg-green-50 flex items-center justify-center">
                            <i class="fas fa-euro-sign text-3xl text-green-600"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow-lg p-6 border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 font-semibold mb-1">Países Visitados</p>
                            <p class="text-4xl font-bold text-gray-900">{{ $reservas->pluck('vacacion.pais')->unique()->count() }}</p>
                        </div>
                        <div class="w-16 h-16 bg-purple-50 flex items-center justify-center">
                            <i class="fas fa-globe-americas text-3xl text-purple-600"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lista de Reservas -->
            <div class="space-y-6">
                @foreach($reservas as $reserva)
                    <article class="elegant-card overflow-hidden group">
                        <div class="grid grid-cols-1 lg:grid-cols-4 gap-0">
                            <!-- Imagen -->
                            <div class="lg:col-span-1 h-48 lg:h-auto relative overflow-hidden">
                                <img src="{{ $reserva->vacacion->imagen_principal }}" 
                                     alt="{{ $reserva->vacacion->titulo }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                <div class="absolute top-4 left-4">
                                    <span class="px-3 py-1 bg-white/95 backdrop-blur-sm text-blue-600 text-xs font-bold tracking-wide uppercase shadow-lg">
                                        {{ $reserva->vacacion->tipo->nombre }}
                                    </span>
                                </div>
                            </div>

                            <!-- Información -->
                            <div class="lg:col-span-2 p-8">
                                <h3 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition">
                                    {{ $reserva->vacacion->titulo }}
                                </h3>
                                
                                <div class="flex items-center text-gray-600 mb-2">
                                    <i class="fas fa-map-marker-alt text-red-500 mr-2"></i>
                                    <span class="font-semibold">{{ $reserva->vacacion->pais }}</span>
                                </div>
                                
                                <div class="flex items-center text-sm text-gray-500 mb-4">
                                    <i class="fas fa-calendar mr-2"></i>
                                    <span>Reservado {{ $reserva->created_at->diffForHumans() }}</span>
                                </div>

                                <p class="text-gray-600 line-clamp-3 mb-4 leading-relaxed">
                                    {{ $reserva->vacacion->descripcion }}
                                </p>

                                <div class="flex flex-wrap gap-2">
                                    @if($reserva->vacacion->fotos->count() > 0)
                                        <span class="px-3 py-1 bg-blue-50 text-blue-700 text-xs font-semibold">
                                            <i class="fas fa-images mr-1"></i>
                                            {{ $reserva->vacacion->fotos->count() }} fotos
                                        </span>
                                    @endif
                                    @if($reserva->vacacion->comentarios->count() > 0)
                                        <span class="px-3 py-1 bg-purple-50 text-purple-700 text-xs font-semibold">
                                            <i class="fas fa-comments mr-1"></i>
                                            {{ $reserva->vacacion->comentarios->count() }} comentarios
                                        </span>
                                    @endif
                                    <span class="px-3 py-1 bg-green-50 text-green-700 text-xs font-semibold">
                                        <i class="fas fa-check-circle mr-1"></i>
                                        Reserva activa
                                    </span>
                                </div>
                            </div>

                            <!-- Acciones y Precio -->
                            <div class="lg:col-span-1 p-8 bg-gray-50 border-t lg:border-t-0 lg:border-l border-gray-100 flex flex-col justify-between">
                                <div class="mb-6">
                                    <p class="text-sm text-gray-600 mb-1">Precio del paquete</p>
                                    <p class="text-5xl font-bold text-gray-900 mb-1">
                                        {{ number_format($reserva->vacacion->precio, 0) }}€
                                    </p>
                                    <p class="text-xs text-gray-500">IVA incluido</p>
                                </div>

                                <div class="space-y-3">
                                    <a href="{{ route('vacaciones.show', $reserva->vacacion) }}" 
                                       class="block w-full text-center px-4 py-3 text-white font-bold shadow-md hover:shadow-lg transition"
                                       style="background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%);">
                                        <i class="fas fa-eye mr-2"></i>
                                        Ver Detalles
                                    </a>

                                    <button onclick="openModal('cancel-reserva-modal-{{ $reserva->id }}')"
        class="w-full px-4 py-3 bg-red-500 text-white font-bold hover:bg-red-600 transition shadow-md">
    <i class="fas fa-times-circle mr-2"></i>
    Cancelar Reserva
</button>
                                </div>
                            </div>
                        </div>
                    </article>


                    <!-- Modal para CANCELAR reserva -->
<div id="cancel-reserva-modal-{{ $reserva->id }}" class="hidden fixed inset-0 z-50 overflow-y-auto" style="background-color: rgba(0, 0, 0, 0.5);">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-yellow-100 flex items-center justify-center mr-4 rounded">
                        <i class="fas fa-exclamation-triangle text-2xl text-yellow-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Cancelar Reserva</h3>
                </div>
                
                <p class="text-gray-700 mb-4">
                    ¿Estás seguro de que deseas cancelar tu reserva para <strong>"{{ $reserva->vacacion->titulo }}"</strong>?
                </p>

                <div class="bg-blue-50 border border-blue-200 p-4 mb-6 rounded">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm text-gray-600">Destino:</span>
                        <span class="text-sm font-semibold text-gray-900">{{ $reserva->vacacion->pais }}</span>
                    </div>
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm text-gray-600">Precio:</span>
                        <span class="text-sm font-semibold text-gray-900">{{ number_format($reserva->vacacion->precio, 0) }}€</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Reservado:</span>
                        <span class="text-sm font-semibold text-gray-900">{{ $reserva->created_at->diffForHumans() }}</span>
                    </div>
                </div>

                <p class="text-sm text-gray-600 mb-6">
                    <i class="fas fa-info-circle mr-2"></i>
                    Podrás volver a reservar este paquete en cualquier momento.
                </p>

                <form action="{{ route('reservas.destroy', $reserva->vacacion) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="flex justify-end gap-3">
                        <button type="button"
                                onclick="closeModal('cancel-reserva-modal-{{ $reserva->id }}')"
                                class="px-6 py-2 border-2 border-gray-300 font-semibold text-gray-700 hover:bg-gray-50 transition">
                            Mantener Reserva
                        </button>
                        <button type="submit" 
                                class="px-6 py-2 bg-red-600 text-white font-semibold hover:bg-red-700 transition">
                            <i class="fas fa-times-circle mr-2"></i>
                            Sí, Cancelar Reserva
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
                @endforeach
            </div>

            <!-- Información Adicional -->
            <div class="mt-8 bg-blue-50 p-8 border border-blue-200">
                <h4 class="font-bold text-gray-900 mb-4 flex items-center text-lg">
                    <i class="fas fa-info-circle mr-2 text-blue-600"></i>
                    Información sobre tus reservas
                </h4>
                <ul class="space-y-3 text-gray-700">
                    <li class="flex items-start">
                        <i class="fas fa-check-circle mr-3 mt-0.5 text-blue-600"></i>
                        <span>Puedes cancelar tus reservas en cualquier momento desde esta página</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle mr-3 mt-0.5 text-blue-600"></i>
                        <span>Solo los usuarios con reservas activas pueden comentar en los paquetes</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle mr-3 mt-0.5 text-blue-600"></i>
                        <span>Todas tus reservas están protegidas con cancelación gratuita</span>
                    </li>
                </ul>
            </div>

        @else
            <!-- Sin Reservas -->
            <div class="bg-white shadow-lg p-16 text-center border border-gray-100">
                <div class="w-32 h-32 mx-auto mb-8 bg-blue-50 flex items-center justify-center">
                    <i class="fas fa-suitcase text-7xl text-blue-600"></i>
                </div>
                <h3 class="text-4xl font-bold text-gray-900 mb-4">
                    Aún no tienes reservas
                </h3>
                <p class="text-xl text-gray-600 mb-12 max-w-md mx-auto leading-relaxed">
                    ¡Es hora de planear tu próxima aventura! Explora nuestros increíbles paquetes vacacionales y comienza a crear recuerdos inolvidables.
                </p>
                
                <!-- Beneficios -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12 max-w-4xl mx-auto">
                    <div class="text-center">
                        <div class="w-16 h-16 mx-auto mb-4 bg-green-50 flex items-center justify-center">
                            <i class="fas fa-credit-card text-3xl text-blue-600"></i>
                        </div>
                        <h4 class="font-bold text-gray-900 mb-2 text-lg">100% Seguro</h4>
                        <p class="text-gray-600">Protección total en tus reservas</p>
                    </div>
                    <div class="text-center">
                        <div class="w-16 h-16 mx-auto mb-4 bg-yellow-50 flex items-center justify-center">
                            <i class="fas fa-hand-holding-usd text-3xl text-yellow-600"></i>
                        </div>
                        <h4 class="font-bold text-gray-900 mb-2 text-lg">Mejor Precio</h4>
                        <p class="text-gray-600">Garantía de precio más bajo</p>
                    </div>
                    <div class="text-center">
                        <div class="w-16 h-16 mx-auto mb-4 bg-purple-50 flex items-center justify-center">
                            <i class="fas fa-headset text-3xl text-purple-600"></i>
                        </div>
                        <h4 class="font-bold text-gray-900 mb-2 text-lg">Soporte 24/7</h4>
                        <p class="text-gray-600">Estamos aquí para ayudarte</p>
                    </div>
                </div>

                <a href="{{ route('vacaciones.index') }}" 
                   class="inline-flex items-center px-10 py-4 text-white font-bold text-lg shadow-lg hover:shadow-xl transition-all duration-300"
                   style="background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%);">
                    <i class="fas fa-compass mr-3"></i>
                    Explorar Paquetes Vacacionales
                    <i class="fas fa-arrow-right ml-3"></i>
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