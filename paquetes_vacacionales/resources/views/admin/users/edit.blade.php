<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-3xl font-bold text-gray-900 flex items-center">
                <i class="fas fa-user-edit text-yellow-600 mr-3"></i>
                Editar Usuario
            </h2>
            <a href="{{ route('admin.users.index') }}" 
               class="px-6 py-2 bg-gray-100 text-gray-700 font-semibold hover:bg-gray-200 transition">
                <i class="fas fa-arrow-left mr-2"></i>
                Volver
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white shadow-lg p-10 border border-gray-100">
                <!-- Información del Usuario -->
                <div class="mb-8 p-6 bg-gray-50 border border-gray-200">
                    <div class="flex items-center">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center text-white font-bold text-2xl mr-4">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-gray-900">{{ $user->name }}</h3>
                            <p class="text-gray-600">{{ $user->email }}</p>
                            <p class="text-sm text-gray-500 mt-1">
                                <i class="fas fa-clock mr-1"></i>
                                Registrado {{ $user->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Estadísticas del Usuario -->
                <div class="grid grid-cols-3 gap-4 mb-8">
                    <div class="text-center p-4 bg-blue-50 border border-blue-200">
                        <i class="fas fa-suitcase text-2xl text-blue-600 mb-2"></i>
                        <p class="text-2xl font-bold text-gray-900">{{ $user->reservas->count() }}</p>
                        <p class="text-sm text-gray-600">Reservas</p>
                    </div>
                    <div class="text-center p-4 bg-amber-50 border border-amber-200">
                        <i class="fas fa-globe-americas text-2xl text-amber-600 mb-2"></i>
                        <p class="text-2xl font-bold text-gray-900">{{ $user->vacaciones->count() }}</p>
                        <p class="text-sm text-gray-600">Paquetes</p>
                    </div>
                    <div class="text-center p-4 bg-purple-50 border border-purple-200">
                        <i class="fas fa-comments text-2xl text-purple-600 mb-2"></i>
                        <p class="text-2xl font-bold text-gray-900">{{ $user->comentarios->count() }}</p>
                        <p class="text-sm text-gray-600">Comentarios</p>
                    </div>
                </div>

                <div class="section-divider mb-8"></div>

                <!-- Formulario -->
                <form action="{{ route('admin.users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Nombre -->
                    <div class="mb-6">
                        <label class="block text-sm font-bold text-gray-700 mb-2">
                            <i class="fas fa-user text-blue-600 mr-2"></i>
                            Nombre Completo *
                        </label>
                        <input type="text" 
                               name="name" 
                               value="{{ old('name', $user->name) }}"
                               class="w-full px-4 py-3 border-2 border-gray-200 focus:border-blue-600 focus:ring-2 focus:ring-blue-200 transition @error('name') border-red-500 @enderror"
                               required>
                        @error('name')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-6">
                        <label class="block text-sm font-bold text-gray-700 mb-2">
                            <i class="fas fa-envelope text-green-600 mr-2"></i>
                            Correo Electrónico *
                        </label>
                        <input type="email" 
                               name="email" 
                               value="{{ old('email', $user->email) }}"
                               class="w-full px-4 py-3 border-2 border-gray-200 focus:border-blue-600 focus:ring-2 focus:ring-blue-200 transition @error('email') border-red-500 @enderror"
                               required>
                        @error('email')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Rol -->
                    <div class="mb-8">
                        <label class="block text-sm font-bold text-gray-700 mb-3">
                            <i class="fas fa-shield-alt text-purple-600 mr-2"></i>
                            Rol del Usuario *
                        </label>
                        
                        <div class="space-y-3">
                            <!-- Admin -->
                            <label class="flex items-center p-4 border-2 cursor-pointer transition hover:bg-gray-50 {{ old('rol', $user->rol) == 'admin' ? 'border-red-500 bg-red-50' : 'border-gray-200' }}">
                                <input type="radio" 
                                       name="rol" 
                                       value="admin" 
                                       {{ old('rol', $user->rol) == 'admin' ? 'checked' : '' }}
                                       class="w-5 h-5 text-red-600">
                                <div class="ml-4 flex-1">
                                    <div class="flex items-center">
                                        <span class="px-3 py-1 rounded-full text-xs font-bold mr-3"
                                              style="background: linear-gradient(135deg, #FF9B85 0%, #FF6B6B 100%); color: white;">
                                            <i class="fas fa-crown mr-1"></i>ADMIN
                                        </span>
                                        <span class="font-bold text-gray-900">Administrador</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mt-1">
                                        Acceso total al sistema. Puede gestionar usuarios, crear/editar/eliminar cualquier paquete y comentario.
                                    </p>
                                </div>
                            </label>

                            <!-- Advanced -->
                            <label class="flex items-center p-4 border-2 cursor-pointer transition hover:bg-gray-50 {{ old('rol', $user->rol) == 'advanced' ? 'border-amber-500 bg-amber-50' : 'border-gray-200' }}">
                                <input type="radio" 
                                       name="rol" 
                                       value="advanced" 
                                       {{ old('rol', $user->rol) == 'advanced' ? 'checked' : '' }}
                                       class="w-5 h-5 text-amber-600">
                                <div class="ml-4 flex-1">
                                    <div class="flex items-center">
                                        <span class="px-3 py-1 rounded-full text-xs font-bold mr-3"
                                              style="background: linear-gradient(135deg, #FFE66D 0%, #FFA500 100%); color: #2C5F8D;">
                                            <i class="fas fa-star mr-1"></i>ADVANCED
                                        </span>
                                        <span class="font-bold text-gray-900">Usuario Avanzado</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mt-1">
                                        Puede crear y gestionar sus propios paquetes vacacionales. No puede gestionar usuarios ni contenido de otros.
                                    </p>
                                </div>
                            </label>

                            <!-- Normal -->
                            <label class="flex items-center p-4 border-2 cursor-pointer transition hover:bg-gray-50 {{ old('rol', $user->rol) == 'normal' ? 'border-gray-500 bg-gray-50' : 'border-gray-200' }}">
                                <input type="radio" 
                                       name="rol" 
                                       value="normal" 
                                       {{ old('rol', $user->rol) == 'normal' ? 'checked' : '' }}
                                       class="w-5 h-5 text-gray-600">
                                <div class="ml-4 flex-1">
                                    <div class="flex items-center">
                                        <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-bold mr-3">
                                            <i class="fas fa-user mr-1"></i>NORMAL
                                        </span>
                                        <span class="font-bold text-gray-900">Usuario Normal</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mt-1">
                                        Puede reservar paquetes, comentar en reservas propias y ver contenido. No puede crear paquetes.
                                    </p>
                                </div>
                            </label>
                        </div>

                        @error('rol')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Advertencia si cambia rol -->
                    @if($user->isAdvanced() && $user->vacaciones->count() > 0)
                        <div class="mb-8 bg-yellow-50 border-2 border-yellow-200 p-4">
                            <p class="text-sm text-yellow-800 font-semibold">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                Advertencia: Este usuario tiene {{ $user->vacaciones->count() }} paquete(s) vacacional(es) creado(s). 
                                Si cambias su rol a "Normal", ya no podrá editarlos.
                            </p>
                        </div>
                    @endif

                    <!-- Botones -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-8 border-t-2 border-gray-200">
                        <button type="submit" 
                                class="flex-1 inline-flex items-center justify-center px-8 py-4 bg-yellow-500 text-white font-bold text-lg shadow-lg hover:shadow-xl hover:bg-yellow-600 transition-all duration-300">
                            <i class="fas fa-save mr-2"></i>
                            Guardar Cambios
                        </button>
                        <a href="{{ route('admin.users.index') }}" 
                           class="flex-1 inline-flex items-center justify-center px-8 py-4 border-2 border-gray-300 text-gray-700 font-bold hover:bg-gray-50 transition-all duration-300 text-lg">
                            <i class="fas fa-times mr-2"></i>
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>

            <!-- Información Adicional -->
            <div class="mt-6 bg-blue-50 p-8 border border-blue-200">
                <h4 class="font-bold text-gray-900 mb-4 flex items-center text-lg">
                    <i class="fas fa-info-circle mr-2 text-blue-600"></i>
                    Información sobre roles
                </h4>
                <ul class="space-y-3 text-gray-700">
                    <li class="flex items-start">
                        <i class="fas fa-check-circle mr-3 mt-0.5 text-blue-600"></i>
                        <span>Los <strong>administradores</strong> tienen control total del sistema</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle mr-3 mt-0.5 text-blue-600"></i>
                        <span>Los <strong>usuarios avanzados</strong> pueden crear y gestionar sus propios paquetes</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle mr-3 mt-0.5 text-blue-600"></i>
                        <span>Los <strong>usuarios normales</strong> solo pueden reservar y comentar</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle mr-3 mt-0.5 text-blue-600"></i>
                        <span>Los cambios de rol son inmediatos y afectan los permisos del usuario</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>


