<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800|playfair-display:400,500,600,700,800&display=swap" rel="stylesheet" />
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        :root {
            --color-primary: #0284c7;
            --color-primary-dark: #0369a1;
            --color-secondary: #64748b;
            --color-accent: #0ea5e9;
        }
        
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
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen pattern-lines">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white border-b border-gray-200 shadow-sm">
                <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Mensajes de éxito -->
                @if(session('success'))
                    <div x-data="{ show: true }" 
                         x-show="show" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         x-init="setTimeout(() => show = false, 5000)" 
                         class="mb-6 bg-white border-l-4 border-emerald-500 p-5 shadow-sm">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-10 h-10 bg-emerald-50 flex items-center justify-center mr-4">
                                <i class="fas fa-check text-emerald-600 text-lg"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-gray-900 font-semibold">{{ session('success') }}</p>
                            </div>
                            <button @click="show = false" class="text-gray-400 hover:text-gray-600">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                @endif

                <!-- Mensajes de error -->
                @if(session('error'))
                    <div x-data="{ show: true }" 
                         x-show="show" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         x-init="setTimeout(() => show = false, 5000)" 
                         class="mb-6 bg-white border-l-4 border-red-500 p-5 shadow-sm">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-10 h-10 bg-red-50 flex items-center justify-center mr-4">
                                <i class="fas fa-exclamation-circle text-red-600 text-lg"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-gray-900 font-semibold">{{ session('error') }}</p>
                            </div>
                            <button @click="show = false" class="text-gray-400 hover:text-gray-600">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                @endif

                <!-- Errores de validación -->
                @if($errors->any())
                    <div class="mb-6 bg-white border-l-4 border-amber-500 p-5 shadow-sm">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-10 h-10 bg-amber-50 flex items-center justify-center mr-4 mt-1">
                                <i class="fas fa-exclamation-triangle text-amber-600 text-lg"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-gray-900 font-semibold mb-3">Hay errores en el formulario:</p>
                                <ul class="space-y-2 text-gray-700">
                                    @foreach($errors->all() as $error)
                                        <li class="flex items-start">
                                            <i class="fas fa-circle text-amber-500 text-xs mr-2 mt-1.5"></i>
                                            <span>{{ $error }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                {{ $slot }}
            </div>
        </main>

        <!-- Footer Minimalista -->
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
    </div>
</body>
</html>