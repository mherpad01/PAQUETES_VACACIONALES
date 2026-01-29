<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-sky-50 via-white to-blue-50">
        <div class="max-w-md w-full">
            <!-- Logo y Header -->
            <div class="text-center mb-8">
                <a href="{{ route('home') }}" class="inline-flex items-center justify-center mb-6">
                    <div class="relative overflow-hidden rounded-xl shadow-lg">
                        <img src="https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=120&h=120&fit=crop&q=80" 
                             alt="Wanderluxe" 
                             class="w-16 h-16 object-cover">
                        <div class="absolute inset-0 bg-gradient-to-br from-sky-500/20 to-blue-600/20"></div>
                    </div>
                </a>
                <h2 class="text-3xl font-bold bg-gradient-to-r from-sky-600 via-blue-600 to-indigo-600 bg-clip-text text-transparent mb-2">
                    Comienza tu aventura
                </h2>
                <p class="text-gray-600">
                    Crea tu cuenta y descubre el mundo
                </p>
            </div>

            <!-- Card del Formulario -->
            <div class="bg-white shadow-xl rounded-2xl p-8 border border-gray-100">
                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nombre Completo
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <input id="name" 
                                   type="text" 
                                   name="name" 
                                   value="{{ old('name') }}"
                                   required 
                                   autofocus 
                                   autocomplete="name"
                                   class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-colors"
                                   placeholder="Juan Pérez">
                        </div>
                        @error('name')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                            Correo Electrónico
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input id="email" 
                                   type="email" 
                                   name="email" 
                                   value="{{ old('email') }}"
                                   required 
                                   autocomplete="username"
                                   class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-colors"
                                   placeholder="tu@email.com">
                        </div>
                        @error('email')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                            Contraseña
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input id="password" 
                                   type="password" 
                                   name="password"
                                   required 
                                   autocomplete="new-password"
                                   class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-colors"
                                   placeholder="Mínimo 8 caracteres">
                        </div>
                        @error('password')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                            Confirmar Contraseña
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input id="password_confirmation" 
                                   type="password" 
                                   name="password_confirmation"
                                   required 
                                   autocomplete="new-password"
                                   class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-colors"
                                   placeholder="Repite tu contraseña">
                        </div>
                        @error('password_confirmation')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Password Requirements -->
                    <div class="bg-sky-50 border border-sky-200 rounded-lg p-4">
                        <p class="text-xs font-semibold text-sky-900 mb-2 flex items-center">
                            <i class="fas fa-info-circle mr-2"></i>
                            Requisitos de contraseña:
                        </p>
                        <ul class="text-xs text-sky-700 space-y-1">
                            <li class="flex items-center">
                                <i class="fas fa-check text-sky-500 mr-2"></i>
                                Mínimo 8 caracteres
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-sky-500 mr-2"></i>
                                Se recomienda usar letras, números y símbolos
                            </li>
                        </ul>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            class="w-full flex items-center justify-center px-6 py-3 bg-gradient-to-r from-sky-600 to-blue-700 text-white font-semibold rounded-lg shadow-md hover:shadow-lg hover:from-sky-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 transition-all duration-300">
                        <i class="fas fa-rocket mr-2"></i>
                        Crear Cuenta
                    </button>

                    <!-- Divider -->
                    <div class="relative my-6">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-200"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 bg-white text-gray-500 font-medium">
                                ¿Ya tienes cuenta?
                            </span>
                        </div>
                    </div>

                    <!-- Login Link -->
                    <a href="{{ route('login') }}" 
                       class="w-full flex items-center justify-center px-6 py-3 border-2 border-sky-600 text-sky-600 font-semibold rounded-lg hover:bg-sky-50 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 transition-all duration-300">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Iniciar Sesión
                    </a>
                </form>
            </div>

            <!-- Back to Home -->
            <div class="text-center mt-6">
                <a href="{{ route('home') }}" 
                   class="inline-flex items-center text-sm text-gray-600 hover:text-sky-600 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Volver al inicio
                </a>
            </div>

            <!-- Terms -->
            <p class="text-center text-xs text-gray-500 mt-6">
                Al registrarte, aceptas nuestros 
                <a href="#" class="text-sky-600 hover:text-sky-700 underline">Términos de Servicio</a> 
                y 
                <a href="#" class="text-sky-600 hover:text-sky-700 underline">Política de Privacidad</a>
            </p>
        </div>
    </div>
</x-guest-layout>