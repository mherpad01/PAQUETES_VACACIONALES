<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-users-cog text-red-600 mr-3"></i>
                    Gestión de Usuarios
                </h2>
                <p class="text-gray-600 mt-2">Administra todos los usuarios del sistema</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="px-5 py-2.5 rounded-full text-sm font-bold shadow-lg"
                      style="background: linear-gradient(135deg, #FF9B85 0%, #FF6B6B 100%); color: white;">
                    <i class="fas fa-crown mr-2"></i>PANEL DE ADMINISTRACIÓN
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <!-- Estadísticas -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="elegant-card overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center shadow-lg">
                            <i class="fas fa-users text-2xl text-white"></i>
                        </div>
                    </div>
                    <p class="text-4xl font-bold text-gray-900 mb-1">{{ $users->total() }}</p>
                    <p class="text-sm text-gray-600 font-medium">Total Usuarios</p>
                </div>
            </div>

            <div class="elegant-card overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-red-500 to-red-700 flex items-center justify-center shadow-lg">
                            <i class="fas fa-crown text-2xl text-white"></i>
                        </div>
                    </div>
                    <p class="text-4xl font-bold text-gray-900 mb-1">{{ \App\Models\User::where('rol', 'admin')->count() }}</p>
                    <p class="text-sm text-gray-600 font-medium">Administradores</p>
                </div>
            </div>

            <div class="elegant-card overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center shadow-lg">
                            <i class="fas fa-star text-2xl text-white"></i>
                        </div>
                    </div>
                    <p class="text-4xl font-bold text-gray-900 mb-1">{{ \App\Models\User::where('rol', 'advanced')->count() }}</p>
                    <p class="text-sm text-gray-600 font-medium">Usuarios Avanzados</p>
                </div>
            </div>

            <div class="elegant-card overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-gray-500 to-gray-700 flex items-center justify-center shadow-lg">
                            <i class="fas fa-user text-2xl text-white"></i>
                        </div>
                    </div>
                    <p class="text-4xl font-bold text-gray-900 mb-1">{{ \App\Models\User::where('rol', 'normal')->count() }}</p>
                    <p class="text-sm text-gray-600 font-medium">Usuarios Normales</p>
                </div>
            </div>
        </div>

        <!-- Tabla de Usuarios -->
        <div class="bg-white shadow-lg border border-gray-100">
            <div class="p-6 border-b border-gray-200 bg-gray-50">
                <h3 class="text-2xl font-bold text-gray-900">Listado de Usuarios</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b-2 border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Usuario
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Email
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Rol
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Estadísticas
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Registrado
                            </th>
                            <th class="px-6 py-4 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($users as $user)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center text-white font-bold mr-3">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="font-bold text-gray-900">{{ $user->name }}</div>
                                            @if($user->id === auth()->id())
                                                <span class="text-xs text-blue-600 font-semibold">(Tú)</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-600">{{ $user->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($user->isAdmin())
                                        <span class="px-3 py-1 rounded-full text-xs font-bold shadow-md"
                                              style="background: linear-gradient(135deg, #FF9B85 0%, #FF6B6B 100%); color: white;">
                                            <i class="fas fa-crown mr-1"></i>Admin
                                        </span>
                                    @elseif($user->isAdvanced())
                                        <span class="px-3 py-1 rounded-full text-xs font-bold shadow-md"
                                              style="background: linear-gradient(135deg, #FFE66D 0%, #FFA500 100%); color: #2C5F8D;">
                                            <i class="fas fa-star mr-1"></i>Advanced
                                        </span>
                                    @else
                                        <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-bold shadow-sm">
                                            <i class="fas fa-user mr-1"></i>Normal
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm space-y-1">
                                        <div class="flex items-center text-gray-600">
                                            <i class="fas fa-suitcase text-blue-500 mr-2 w-4"></i>
                                            <span>{{ $user->reservas->count() }} reservas</span>
                                        </div>
                                        @if($user->canCreateVacaciones())
                                            <div class="flex items-center text-gray-600">
                                                <i class="fas fa-globe-americas text-amber-500 mr-2 w-4"></i>
                                                <span>{{ $user->vacaciones->count() }} paquetes</span>
                                            </div>
                                        @endif
                                        <div class="flex items-center text-gray-600">
                                            <i class="fas fa-comments text-purple-500 mr-2 w-4"></i>
                                            <span>{{ $user->comentarios->count() }} comentarios</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-600">
                                        <i class="fas fa-clock mr-1"></i>
                                        {{ $user->created_at->diffForHumans() }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.users.edit', $user) }}" 
                                           class="px-3 py-2 bg-yellow-500 text-white font-semibold hover:bg-yellow-600 transition">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @if($user->id !== auth()->id())
                                            <button onclick="openModal('delete-user-modal-{{ $user->id }}')"
                                                    class="px-3 py-2 bg-red-500 text-white font-semibold hover:bg-red-600 transition">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal de Eliminación -->
                            @if($user->id !== auth()->id())
                                <tr>
                                    <td colspan="6" class="p-0">
                                        <div id="delete-user-modal-{{ $user->id }}" class="hidden fixed inset-0 z-50 overflow-y-auto" style="background-color: rgba(0, 0, 0, 0.5);">
                                            <div class="flex items-center justify-center min-h-screen px-4">
                                                <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full">
                                                    <div class="p-6">
                                                        <div class="flex items-center mb-4">
                                                            <div class="w-12 h-12 bg-red-100 flex items-center justify-center mr-4 rounded">
                                                                <i class="fas fa-exclamation-triangle text-2xl text-red-600"></i>
                                                            </div>
                                                            <h3 class="text-xl font-bold text-gray-900">Eliminar Usuario</h3>
                                                        </div>
                                                        
                                                        @if($user->reservas()->count() > 0 || $user->vacaciones()->count() > 0)
                                                            <!-- Si tiene datos relacionados -->
                                                            <div class="bg-red-50 border-2 border-red-300 p-6 mb-6 rounded">
                                                                <div class="flex items-start mb-3">
                                                                    <i class="fas fa-ban text-3xl text-red-600 mr-4 mt-1"></i>
                                                                    <div>
                                                                        <h4 class="text-lg font-bold text-red-900 mb-2">No se puede eliminar este usuario</h4>
                                                                        <p class="text-red-800 mb-3">
                                                                            Este usuario tiene datos activos en el sistema:
                                                                        </p>
                                                                        <ul class="ml-4 space-y-1">
                                                                            @if($user->reservas()->count() > 0)
                                                                                <li class="text-sm text-red-700">
                                                                                    <i class="fas fa-suitcase mr-2"></i>{{ $user->reservas()->count() }} reserva(s)
                                                                                </li>
                                                                            @endif
                                                                            @if($user->vacaciones()->count() > 0)
                                                                                <li class="text-sm text-red-700">
                                                                                    <i class="fas fa-globe-americas mr-2"></i>{{ $user->vacaciones()->count() }} paquete(s) vacacional(es)
                                                                                </li>
                                                                            @endif
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <p class="text-sm text-red-800 font-semibold mt-4">
                                                                    <i class="fas fa-info-circle mr-2"></i>
                                                                    Primero deben eliminarse las reservas y paquetes del usuario.
                                                                </p>
                                                            </div>

                                                            <div class="flex justify-end">
                                                                <button type="button"
                                                                        onclick="closeModal('delete-user-modal-{{ $user->id }}')"
                                                                        class="px-6 py-2 bg-gray-600 text-white font-semibold hover:bg-gray-700 transition">
                                                                    Cerrar
                                                                </button>
                                                            </div>
                                                        @else
                                                            <!-- Si NO tiene datos relacionados -->
                                                            <p class="text-gray-700 mb-4">
                                                                ¿Estás seguro de que deseas eliminar al usuario <strong>"{{ $user->name }}"</strong>?
                                                            </p>

                                                            <div class="bg-yellow-50 border border-yellow-200 p-4 mb-6 rounded">
                                                                <p class="text-sm text-yellow-800">
                                                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                                                    <strong>Advertencia:</strong> Esta acción eliminará permanentemente:
                                                                </p>
                                                                <ul class="mt-2 ml-6 text-sm text-yellow-800 list-disc">
                                                                    <li>La cuenta del usuario</li>
                                                                    <li>Todos sus comentarios ({{ $user->comentarios->count() }})</li>
                                                                </ul>
                                                                <p class="mt-2 text-sm text-yellow-800 font-semibold">
                                                                    Esta acción NO se puede deshacer.
                                                                </p>
                                                            </div>

                                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <div class="flex justify-end gap-3">
                                                                    <button type="button"
                                                                            onclick="closeModal('delete-user-modal-{{ $user->id }}')"
                                                                            class="px-6 py-2 border-2 border-gray-300 font-semibold text-gray-700 hover:bg-gray-50 transition">
                                                                        Cancelar
                                                                    </button>
                                                                    <button type="submit" 
                                                                            class="px-6 py-2 bg-red-600 text-white font-semibold hover:bg-red-700 transition">
                                                                        <i class="fas fa-trash mr-2"></i>
                                                                        Sí, Eliminar Usuario
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="text-gray-400">
                                        <i class="fas fa-users text-5xl mb-4"></i>
                                        <p class="text-lg">No hay usuarios registrados</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            @if($users->hasPages())
                <div class="p-6 border-t border-gray-200">
                    {{ $users->links() }}
                </div>
            @endif
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

        // Cerrar modal al hacer clic fuera
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('fixed') && event.target.classList.contains('inset-0')) {
                event.target.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        });

        // Cerrar con ESC
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