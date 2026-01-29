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
                    Bienvenido de nuevo
                </h2>
                <p class="text-gray-600">
                    Inicia sesión para continuar tu aventura
                </p>
            </div>

            <!-- Card del Formulario -->
            <div class="bg-white shadow-xl rounded-2xl p-8 border border-gray-100">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

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
                                   autofocus 
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
                                   autocomplete="current-password"
                                   class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-colors"
                                   placeholder="••••••••">
                        </div>
                        @error('password')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Remember Me y Forgot Password -->
                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="flex items-center cursor-pointer group">
                            <input id="remember_me" 
                                   type="checkbox" 
                                   name="remember"
                                   class="w-4 h-4 text-sky-600 border-gray-300 rounded focus:ring-sky-500 transition-colors">
                            <span class="ml-2 text-sm text-gray-600 group-hover:text-gray-900 transition-colors">
                                Recuérdame
                            </span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" 
                               class="text-sm font-medium text-sky-600 hover:text-sky-700 transition-colors">
                                ¿Olvidaste tu contraseña?
                            </a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            class="w-full flex items-center justify-center px-6 py-3 bg-gradient-to-r from-sky-600 to-blue-700 text-white font-semibold rounded-lg shadow-md hover:shadow-lg hover:from-sky-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 transition-all duration-300">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Iniciar Sesión
                    </button>

                    <!-- Divider -->
                    <div class="relative my-6">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-200"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 bg-white text-gray-500 font-medium">
                                ¿No tienes cuenta?
                            </span>
                        </div>
                    </div>

                    <!-- Register Link -->
                    <a href="{{ route('register') }}" 
                       class="w-full flex items-center justify-center px-6 py-3 border-2 border-sky-600 text-sky-600 font-semibold rounded-lg hover:bg-sky-50 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 transition-all duration-300">
                        <i class="fas fa-user-plus mr-2"></i>
                        Crear Cuenta Nueva
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
        </div>
    </div>
</x-guest-layout>