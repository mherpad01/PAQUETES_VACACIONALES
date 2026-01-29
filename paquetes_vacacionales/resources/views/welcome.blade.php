<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wanderluxe - Experiencias de Viaje Premium</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800|playfair-display:400,500,600,700,800&display=swap" rel="stylesheet" />
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
        }
        
        .pattern-lines {
            background-image: 
                linear-gradient(90deg, rgba(2, 132, 199, 0.03) 1px, transparent 1px),
                linear-gradient(rgba(2, 132, 199, 0.03) 1px, transparent 1px);
            background-size: 40px 40px;
        }
        
        .elegant-card {
            background: white;
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
        }
        
        .elegant-card:hover {
            border-color: #cbd5e1;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transform: translateY(-4px);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
            color: white;
            padding: 1rem 2.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: none;
        }
        
        .btn-primary:hover {
            box-shadow: 0 10px 25px rgba(2, 132, 199, 0.25);
            transform: translateY(-2px);
        }
        
        .btn-secondary {
            padding: 1rem 2.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #0284c7;
            color: #0284c7;
            background: white;
        }
        
        .btn-secondary:hover {
            background: #f0f9ff;
            transform: translateY(-2px);
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .section-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, #e5e7eb 20%, #e5e7eb 80%, transparent);
        }

        .hero-image {
            position: relative;
            overflow: hidden;
        }

        .hero-image::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(2, 132, 199, 0.1), rgba(3, 105, 161, 0.05));
            z-index: 1;
        }
    </style>
</head>
<body class="antialiased pattern-lines bg-gray-50">
    
    @include('layouts.navigation')

    <!-- Hero Section -->
    <section class="py-20 lg:py-32 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <!-- Left Content -->
                <div>
                    <div class="inline-flex items-center px-4 py-2 border border-sky-200 bg-sky-50 mb-8">
                        <span class="w-2 h-2 bg-sky-600 mr-2"></span>
                        <span class="font-semibold text-sm text-sky-900 tracking-wide uppercase">
                            Experiencias Premium
                        </span>
                    </div>

                    <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                        Tu Próxima
                        <span class="block mt-2 gradient-text">
                            Aventura Soñada
                        </span>
                    </h1>

                    <p class="text-xl text-gray-600 mb-10 leading-relaxed max-w-xl">
                        Descubre destinos excepcionales con nuestros paquetes vacacionales cuidadosamente seleccionados. Vive experiencias únicas que recordarás para siempre.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 mb-16">
                        <a href="{{ route('vacaciones.index') }}" class="btn-primary text-lg">
                            Explorar Destinos
                            <i class="fas fa-arrow-right ml-3"></i>
                        </a>
                        @guest
                            <a href="{{ route('register') }}" class="btn-secondary text-lg">
                                Comenzar Ahora
                            </a>
                        @endguest
                    </div>

                    <!-- Trust indicators -->
                    <div class="grid grid-cols-3 gap-8 pt-8 border-t border-gray-200">
                        <div>
                            <div class="text-3xl font-bold text-gray-900 mb-1">{{ \App\Models\Vacacion::count() }}+</div>
                            <p class="text-sm text-gray-600">Destinos</p>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-gray-900 mb-1">{{ \App\Models\User::count() }}+</div>
                            <p class="text-sm text-gray-600">Viajeros</p>
                        </div>
                    </div>
                </div>

                <!-- Right Content - Hero Image -->
                <div class="relative">
                    <div class="hero-image relative shadow-2xl overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=800&h=600&fit=crop" 
                             alt="Destino paradisíaco"
                             class="w-full h-96 lg:h-[600px] object-cover">
                    </div>

                    <!-- Floating Card -->
                    <div class="absolute -bottom-8 -left-8 bg-white shadow-xl p-6 max-w-xs border border-gray-200">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-sky-600 to-blue-700 flex items-center justify-center">
                                <i class="fas fa-globe-americas text-2xl text-white"></i>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-gray-900">50+</p>
                                <p class="text-sm text-gray-600">Países</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="section-divider"></div>

    <!-- Tipos de Viaje Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl lg:text-5xl font-bold mb-4 text-gray-900">
                    Categorías de Viaje
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Encuentra el estilo de viaje perfecto para ti
                </p>
            </div>

            @php
                $tipos = \App\Models\Tipo::all();
            @endphp

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                @foreach($tipos as $tipo)
                    <a href="{{ route('vacaciones.index', ['tipo' => $tipo->id]) }}" 
                       class="elegant-card p-8 text-center group">
                        <div class="w-14 h-14 mx-auto mb-4 bg-sky-50 flex items-center justify-center group-hover:bg-sky-100 transition">
                            <i class="fas fa-map-marked-alt text-2xl text-sky-600"></i>
                        </div>
                        <h3 class="font-bold text-gray-800 group-hover:text-sky-600 transition">{{ $tipo->nombre }}</h3>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <div class="section-divider"></div>

    <!-- Featured Destinations -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="text-4xl lg:text-5xl font-bold mb-4 text-gray-900">
                        Destinos Destacados
                    </h2>
                    <p class="text-xl text-gray-600">
                        Los paquetes más populares
                    </p>
                </div>
                <a href="{{ route('vacaciones.index') }}" 
                   class="hidden md:inline-flex items-center text-sky-600 font-semibold hover:text-sky-800 transition">
                    Ver todos
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            @php
                $destacados = \App\Models\Vacacion::with(['tipo', 'fotos'])
                    ->latest()
                    ->take(6)
                    ->get();
            @endphp

            @if($destacados->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($destacados as $vacacion)
                        <article class="elegant-card overflow-hidden group">
                            <div class="relative h-64 overflow-hidden">
                                <img src="{{ $vacacion->imagen_principal }}" 
                                     alt="{{ $vacacion->titulo }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                
                                <div class="absolute top-4 left-4">
                                    <span class="px-3 py-1 bg-white text-sky-600 text-xs font-bold tracking-wide uppercase shadow-md">
                                        {{ $vacacion->tipo->nombre }}
                                    </span>
                                </div>
                                <div class="absolute top-4 right-4">
                                    <div class="px-4 py-2 bg-white font-bold shadow-md text-gray-900">
                                        {{ number_format($vacacion->precio, 0) }}€
                                    </div>
                                </div>
                            </div>
                            
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-sky-600 transition">
                                    {{ $vacacion->titulo }}
                                </h3>

                                <div class="flex items-center text-gray-600 mb-3">
                                    <i class="fas fa-map-marker-alt text-red-500 mr-2"></i>
                                    <span class="font-medium">{{ $vacacion->pais }}</span>
                                </div>

                                <p class="text-gray-600 mb-4 line-clamp-2 leading-relaxed">
                                    {{ Str::limit($vacacion->descripcion, 100) }}
                                </p>

                                <div class="flex items-center justify-between mb-4 pt-4 border-t border-gray-100">
                                    @if($vacacion->fotos->count() > 0)
                                        <div class="flex items-center text-sm text-gray-500">
                                            <i class="fas fa-images mr-2 text-sky-500"></i>
                                            <span>{{ $vacacion->fotos->count() }} fotos</span>
                                        </div>
                                    @endif
                                    <div class="flex items-center text-sm text-gray-500">
                                        <i class="fas fa-clock mr-2"></i>
                                        <span>{{ $vacacion->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>

                                <a href="{{ route('vacaciones.show', $vacacion) }}" 
                                   class="block w-full text-center px-6 py-3 border-2 border-sky-600 text-sky-600 font-bold hover:bg-sky-600 hover:text-white transition">
                                    Ver Detalles
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="text-center mt-12">
                    <a href="{{ route('vacaciones.index') }}" 
                       class="btn-secondary text-lg">
                        Ver Todos los Paquetes
                        <i class="fas fa-arrow-right ml-3"></i>
                    </a>
                </div>
            @else
                <div class="text-center py-20 bg-white border border-gray-200">
                    <div class="w-20 h-20 mx-auto mb-6 bg-sky-50 flex items-center justify-center">
                        <i class="fas fa-suitcase text-5xl text-sky-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Próximamente</h3>
                    <p class="text-lg text-gray-600">
                        Estamos preparando increíbles paquetes para ti
                    </p>
                </div>
            @endif
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-3 gap-12">
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto mb-6 bg-sky-50 flex items-center justify-center">
                        <i class="fas fa-credit-card text-3xl text-sky-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Pago Seguro</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Transacciones protegidas con los más altos estándares de seguridad
                    </p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 mx-auto mb-6 bg-sky-50 flex items-center justify-center">
                        <i class="fas fa-headset text-3xl text-sky-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Soporte 24/7</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Asistencia personalizada en cualquier momento que lo necesites
                    </p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 mx-auto mb-6 bg-sky-50 flex items-center justify-center">
                        <i class="fas fa-medal text-3xl text-sky-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Mejor Precio</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Garantizamos las tarifas más competitivas del mercado
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    @guest
        <section class="py-20 bg-gradient-to-br from-sky-600 to-blue-700">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-4xl lg:text-5xl font-bold mb-6 text-white">
                    Comienza Tu Aventura Hoy
                </h2>
                <p class="text-xl mb-10 text-sky-100 max-w-2xl mx-auto">
                    Únete a miles de viajeros que confían en nosotros para crear experiencias inolvidables
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('register') }}" 
                       class="inline-flex items-center justify-center px-10 py-4 bg-white text-sky-900 font-bold shadow-lg hover:shadow-xl transition text-lg">
                        <i class="fas fa-rocket mr-3"></i>
                        Registrarse Gratis
                    </a>
                    <a href="{{ route('vacaciones.index') }}" 
                       class="inline-flex items-center justify-center px-10 py-4 border-2 border-white text-white font-bold hover:bg-white hover:bg-opacity-10 transition text-lg">
                        <i class="fas fa-search mr-3"></i>
                        Explorar Paquetes
                    </a>
                </div>
            </div>
        </section>
    @endguest

    <!-- Footer - Actualizado para coincidir con el resto de la app -->
    <footer class="mt-20 bg-white border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center mb-6">
                        <div class="relative overflow-hidden rounded-xl shadow-md">
                            <img src="https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=120&h=120&fit=crop&q=80" 
                                 alt="Wanderluxe" 
                                 class="w-12 h-12 object-cover">
                            <div class="absolute inset-0 bg-gradient-to-br from-sky-500/20 to-blue-600/20"></div>
                        </div>
                        <span class="text-2xl font-bold bg-gradient-to-r from-sky-600 via-blue-600 to-indigo-600 bg-clip-text text-transparent ml-3">Wanderluxe</span>
                    </div>
                    <p class="text-gray-600 leading-relaxed max-w-md">
                        Experiencias de viaje premium. Descubre destinos únicos y crea recuerdos inolvidables con nuestros paquetes cuidadosamente seleccionados.
                    </p>
                </div>

                <div>
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4">Enlaces</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('vacaciones.index') }}" class="text-gray-600 hover:text-sky-600 transition">Paquetes</a></li>
                        @auth
                            <li><a href="{{ route('reservas.mis-reservas') }}" class="text-gray-600 hover:text-sky-600 transition">Mis Reservas</a></li>
                            <li><a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-sky-600 transition">Dashboard</a></li>
                        @else
                            <li><a href="{{ route('login') }}" class="text-gray-600 hover:text-sky-600 transition">Iniciar Sesión</a></li>
                            <li><a href="{{ route('register') }}" class="text-gray-600 hover:text-sky-600 transition">Registrarse</a></li>
                        @endauth
                    </ul>
                </div>

                <div>
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4">Contacto</h3>
                    <ul class="space-y-3 text-gray-600">
                        <li class="flex items-center">
                            <i class="fas fa-envelope w-5 text-gray-400"></i>
                            <span class="ml-2">info@wanderluxe.com</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone w-5 text-gray-400"></i>
                            <span class="ml-2">+34 900 123 456</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-map-marker-alt w-5 text-gray-400"></i>
                            <span class="ml-2">Madrid, España</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="section-divider my-8"></div>

            <div class="flex flex-col md:flex-row justify-between items-center text-sm text-gray-500">
                <p>&copy; {{ date('Y') }} Wanderluxe. Todos los derechos reservados.</p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#" class="hover:text-sky-600 transition">Política de Privacidad</a>
                    <a href="#" class="hover:text-sky-600 transition">Términos de Servicio</a>
                </div>
            </div>
        </div>
    </footer>

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
</body>
</html>