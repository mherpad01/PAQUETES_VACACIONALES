<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-sky-600 to-blue-700 flex items-center justify-center text-white text-xl font-bold shadow-md mr-4">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <h2 class="font-bold text-2xl text-gray-900">
                        Mi Perfil
                    </h2>
                    <p class="text-sm text-gray-600">
                        Gestiona tu información personal y configuración
                    </p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Información del Perfil -->
            <div class="bg-white shadow-sm rounded-xl border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-sky-50 to-blue-50 px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-sky-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-user-circle text-sky-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">
                                Información del Perfil
                            </h3>
                            <p class="text-sm text-gray-600">
                                Actualiza tu nombre y correo electrónico
                            </p>
                        </div>
                    </div>
                </div>
                <div class="p-6 sm:p-8">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

            <!-- Cambiar Contraseña -->
            <div class="bg-white shadow-sm rounded-xl border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-amber-50 to-orange-50 px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-lock text-amber-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">
                                Actualizar Contraseña
                            </h3>
                            <p class="text-sm text-gray-600">
                                Asegúrate de usar una contraseña segura
                            </p>
                        </div>
                    </div>
                </div>
                <div class="p-6 sm:p-8">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            <!-- Eliminar Cuenta -->
            <div class="bg-white shadow-sm rounded-xl border border-red-200 overflow-hidden">
                <div class="bg-gradient-to-r from-red-50 to-pink-50 px-6 py-4 border-b border-red-200">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">
                                Eliminar Cuenta
                            </h3>
                            <p class="text-sm text-gray-600">
                                Esta acción es permanente y no se puede deshacer
                            </p>
                        </div>
                    </div>
                </div>
                <div class="p-6 sm:p-8">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>

            <!-- Info adicional sobre la cuenta -->
            <div class="bg-gradient-to-br from-sky-500 to-blue-600 rounded-xl shadow-lg p-8 text-white">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center backdrop-blur-sm">
                            <i class="fas fa-info-circle text-white text-2xl"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-bold mb-2">
                            Información de tu Cuenta
                        </h3>
                        <div class="space-y-2 text-sky-100">
                            <p class="flex items-center">
                                <i class="fas fa-calendar-alt mr-2"></i>
                                <span>Miembro desde: <strong class="text-white">{{ Auth::user()->created_at->format('d/m/Y') }}</strong></span>
                            </p>
                            <p class="flex items-center">
                                <i class="fas fa-shield-alt mr-2"></i>
                                <span>Tu información está protegida y segura</span>
                            </p>
                            @if(Auth::user()->isAdmin())
                                <p class="flex items-center">
                                    <i class="fas fa-crown mr-2 text-yellow-300"></i>
                                    <span>Rol: <strong class="text-white">Administrador</strong></span>
                                </p>
                            @elseif(Auth::user()->isAdvanced())
                                <p class="flex items-center">
                                    <i class="fas fa-star mr-2 text-yellow-300"></i>
                                    <span>Rol: <strong class="text-white">Usuario Avanzado</strong></span>
                                </p>
                            @else
                                <p class="flex items-center">
                                    <i class="fas fa-user mr-2"></i>
                                    <span>Rol: <strong class="text-white">Usuario</strong></span>
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>