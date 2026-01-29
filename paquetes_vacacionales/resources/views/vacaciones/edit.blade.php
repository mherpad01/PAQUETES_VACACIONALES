<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-3xl font-bold text-gray-900 flex items-center">
                <i class="fas fa-edit text-yellow-600 mr-3"></i>
                Editar Paquete Vacacional
            </h2>
            <a href="{{ route('vacaciones.show', $vacacion) }}" 
               class="px-6 py-2 bg-gray-100 text-gray-700 font-semibold hover:bg-gray-200 transition">
                <i class="fas fa-arrow-left mr-2"></i>
                Volver
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white shadow-lg p-10 border border-gray-100">
                <form action="{{ route('vacaciones.update', $vacacion) }}" 
                      method="POST" 
                      enctype="multipart/form-data"
                      x-data="imagePreview()">
                    @csrf
                    @method('PUT')

                    <!-- Información Básica -->
                    <div class="mb-10">
                        <div class="mb-8">
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">Información Básica</h3>
                            <div class="section-divider"></div>
                        </div>

                        <!-- Título -->
                        <div class="mb-6">
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                <i class="fas fa-heading text-blue-600 mr-2"></i>
                                Título del Paquete *
                            </label>
                            <input type="text" 
                                   name="titulo" 
                                   value="{{ old('titulo', $vacacion->titulo) }}"
                                   placeholder="Ej: Paraíso Tropical en las Maldivas"
                                   class="w-full px-4 py-3 border-2 border-gray-200 focus:border-blue-600 focus:ring-2 focus:ring-blue-200 transition @error('titulo') border-red-500 @enderror"
                                   required>
                            @error('titulo')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Tipo y País -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- Tipo -->
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">
                                    <i class="fas fa-tag text-yellow-600 mr-2"></i>
                                    Tipo de Viaje *
                                </label>
                                <select name="id_tipo" 
                                        class="w-full px-4 py-3 border-2 border-gray-200 focus:border-blue-600 focus:ring-2 focus:ring-blue-200 transition @error('id_tipo') border-red-500 @enderror"
                                        required>
                                    <option value="">Selecciona un tipo</option>
                                    @foreach($tipos as $tipo)
                                        <option value="{{ $tipo->id }}" {{ old('id_tipo', $vacacion->id_tipo) == $tipo->id ? 'selected' : '' }}>
                                            {{ $tipo->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_tipo')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- País -->
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">
                                    <i class="fas fa-map-marker-alt text-red-500 mr-2"></i>
                                    País de Destino *
                                </label>
                                <input type="text" 
                                       name="pais" 
                                       value="{{ old('pais', $vacacion->pais) }}"
                                       placeholder="Ej: Maldivas"
                                       class="w-full px-4 py-3 border-2 border-gray-200 focus:border-blue-600 focus:ring-2 focus:ring-blue-200 transition @error('pais') border-red-500 @enderror"
                                       required>
                                @error('pais')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <!-- Precio -->
                        <div class="mb-6">
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                <i class="fas fa-euro-sign text-green-600 mr-2"></i>
                                Precio (€) *
                            </label>
                            <input type="number" 
                                   name="precio" 
                                   value="{{ old('precio', $vacacion->precio) }}"
                                   placeholder="Ej: 1200"
                                   min="0"
                                   step="0.01"
                                   class="w-full px-4 py-3 border-2 border-gray-200 focus:border-blue-600 focus:ring-2 focus:ring-blue-200 transition @error('precio') border-red-500 @enderror"
                                   required>
                            @error('precio')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Descripción -->
                        <div class="mb-6">
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                <i class="fas fa-align-left text-purple-600 mr-2"></i>
                                Descripción del Paquete *
                            </label>
                            <textarea name="descripcion" 
                                      rows="6"
                                      placeholder="Describe el paquete vacacional detalladamente..."
                                      class="w-full px-4 py-3 border-2 border-gray-200 focus:border-blue-600 focus:ring-2 focus:ring-blue-200 transition resize-none @error('descripcion') border-red-500 @enderror"
                                      required>{{ old('descripcion', $vacacion->descripcion) }}</textarea>
                            @error('descripcion')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Imágenes Existentes -->
                    @if($vacacion->fotos->count() > 0)
                        <div class="mb-10">
                            <div class="mb-8">
                                <h3 class="text-2xl font-bold text-gray-900 mb-2">Imágenes Actuales ({{ $vacacion->fotos->count() }})</h3>
                                <div class="section-divider"></div>
                            </div>

                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                @foreach($vacacion->fotos as $foto)
                                    <div class="relative group">
                                        <img src="{{ $foto->url_completa }}" 
                                             alt="Foto {{ $foto->id }}"
                                             class="w-full h-32 object-cover border-2 border-gray-200">
                                        
                                        <label class="absolute top-2 right-2 w-8 h-8 bg-red-500 text-white flex items-center justify-center cursor-pointer opacity-0 group-hover:opacity-100 transition hover:bg-red-600">
                                            <input type="checkbox" 
                                                   name="eliminar_fotos[]" 
                                                   value="{{ $foto->id }}"
                                                   class="hidden peer">
                                            <i class="fas fa-trash peer-checked:hidden"></i>
                                            <i class="fas fa-check hidden peer-checked:block"></i>
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <p class="mt-4 text-sm text-gray-600 bg-yellow-50 p-4 border border-yellow-200">
                                <i class="fas fa-info-circle text-yellow-600 mr-2"></i>
                                Marca las imágenes que deseas eliminar. Los cambios se aplicarán al guardar.
                            </p>
                        </div>
                    @endif

                    <!-- Nuevas Imágenes -->
                    <div class="mb-10">
                        <div class="mb-8">
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">Agregar Nuevas Imágenes</h3>
                            <div class="section-divider"></div>
                        </div>

                        <div class="mb-4">
                            <div class="relative">
                                <input type="file" 
                                       name="imagenes[]" 
                                       multiple
                                       accept="image/*"
                                       @change="handleFiles($event)"
                                       class="hidden"
                                       id="file-upload">
                                <label for="file-upload" 
                                       class="flex flex-col items-center justify-center w-full h-56 border-3 border-dashed border-yellow-300 cursor-pointer bg-yellow-50 hover:bg-yellow-100 transition">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <i class="fas fa-cloud-upload-alt text-6xl text-yellow-600 mb-4"></i>
                                        <p class="mb-2 text-base text-gray-700">
                                            <span class="font-semibold">Click para subir</span> o arrastra las imágenes
                                        </p>
                                        <p class="text-sm text-gray-500">PNG, JPG, GIF (MAX. 2MB por imagen)</p>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Preview de Nuevas Imágenes -->
                        <div x-show="files.length > 0" class="mt-6">
                            <p class="text-sm font-semibold text-gray-700 mb-4 flex items-center">
                                <i class="fas fa-eye mr-2 text-yellow-600"></i>
                                Vista Previa de Nuevas Imágenes (<span x-text="files.length"></span>)
                            </p>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                <template x-for="(file, index) in files" :key="index">
                                    <div class="relative group">
                                        <img :src="file.url" 
                                             :alt="file.name"
                                             class="w-full h-32 object-cover border-2 border-yellow-300">
                                        <button type="button"
                                                @click="removeFile(index)"
                                                class="absolute top-2 right-2 w-8 h-8 bg-red-500 text-white flex items-center justify-center opacity-0 group-hover:opacity-100 transition hover:bg-red-600">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        <p class="mt-1 text-xs text-gray-500 truncate" x-text="file.name"></p>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-8 border-t-2 border-gray-200">
                        <button type="submit" 
                                class="flex-1 inline-flex items-center justify-center px-8 py-4 bg-yellow-500 text-white font-bold text-lg shadow-lg hover:shadow-xl hover:bg-yellow-600 transition-all duration-300">
                            <i class="fas fa-save mr-2"></i>
                            Guardar Cambios
                        </button>
                        <a href="{{ route('vacaciones.show', $vacacion) }}" 
                           class="flex-1 inline-flex items-center justify-center px-8 py-4 border-2 border-gray-300 text-gray-700 font-bold hover:bg-gray-50 transition-all duration-300 text-lg">
                            <i class="fas fa-times mr-2"></i>
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>

            <!-- Advertencia de Eliminación -->
<div class="mt-6 bg-red-50 p-8 border border-red-200">
    <h4 class="font-bold text-gray-900 mb-4 flex items-center text-lg">
        <i class="fas fa-exclamation-triangle mr-2 text-red-600"></i>
        Eliminar este paquete
    </h4>
    <p class="text-gray-700 mb-6">
        Si deseas eliminar completamente este paquete vacacional, incluyendo todas sus fotos y comentarios, puedes hacerlo aquí. 
        <strong>Esta acción no se puede deshacer.</strong>
    </p>
    <button onclick="openModal('delete-vacacion-edit-modal')"
            class="inline-flex items-center px-8 py-3 bg-red-600 text-white font-bold hover:bg-red-700 transition shadow-md">
        <i class="fas fa-trash-alt mr-2"></i>
        Eliminar Paquete Permanentemente
    </button>
</div>

<!-- Modal para ELIMINAR paquete desde edición -->
<div id="delete-vacacion-edit-modal" class="hidden fixed inset-0 z-50 overflow-y-auto" style="background-color: rgba(0, 0, 0, 0.5);">
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
                                onclick="closeModal('delete-vacacion-edit-modal')"
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
                                    onclick="closeModal('delete-vacacion-edit-modal')"
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
</div>        </div>
    </div>

    <script>
        function imagePreview() {
            return {
                files: [],
                handleFiles(event) {
                    const selectedFiles = Array.from(event.target.files);
                    this.files = selectedFiles.map(file => ({
                        file: file,
                        name: file.name,
                        url: URL.createObjectURL(file)
                    }));
                },
                removeFile(index) {
                    this.files.splice(index, 1);
                    const dt = new DataTransfer();
                    this.files.forEach(f => dt.items.add(f.file));
                    document.getElementById('file-upload').files = dt.files;
                }
            }
        }

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