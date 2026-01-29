<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-gray-900 flex items-center">
            <i class="fas fa-plus-circle text-blue-600 mr-3"></i>
            Crear Nuevo Paquete Vacacional
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white shadow-lg p-10 border border-gray-100">
                <form action="{{ route('vacaciones.store') }}" 
                      method="POST" 
                      enctype="multipart/form-data"
                      x-data="imagePreview()">
                    @csrf

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
                                   value="{{ old('titulo') }}"
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
                                        <option value="{{ $tipo->id }}" {{ old('id_tipo') == $tipo->id ? 'selected' : '' }}>
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
                                       value="{{ old('pais') }}"
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
                                   value="{{ old('precio') }}"
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
                                      placeholder="Describe el paquete vacacional detalladamente... (mínimo 20 caracteres)"
                                      class="w-full px-4 py-3 border-2 border-gray-200 focus:border-blue-600 focus:ring-2 focus:ring-blue-200 transition resize-none @error('descripcion') border-red-500 @enderror"
                                      required>{{ old('descripcion') }}</textarea>
                            @error('descripcion')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                            <p class="mt-2 text-sm text-gray-500">
                                <i class="fas fa-info-circle mr-1"></i>
                                Mínimo 20 caracteres
                            </p>
                        </div>
                    </div>

                    <!-- Imágenes -->
                    <div class="mb-10">
                        <div class="mb-8">
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">Imágenes del Paquete</h3>
                            <div class="section-divider"></div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                <i class="fas fa-camera text-pink-500 mr-2"></i>
                                Subir Imágenes
                            </label>
                            <div class="relative">
                                <input type="file" 
                                       name="imagenes[]" 
                                       multiple
                                       accept="image/*"
                                       @change="handleFiles($event)"
                                       class="hidden"
                                       id="file-upload">
                                <label for="file-upload" 
                                       class="flex flex-col items-center justify-center w-full h-56 border-3 border-dashed border-blue-300 cursor-pointer bg-blue-50 hover:bg-blue-100 transition">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <i class="fas fa-cloud-upload-alt text-6xl text-blue-600 mb-4"></i>
                                        <p class="mb-2 text-base text-gray-700">
                                            <span class="font-semibold">Click para subir</span> o arrastra las imágenes
                                        </p>
                                        <p class="text-sm text-gray-500">PNG, JPG, GIF (MAX. 2MB por imagen)</p>
                                    </div>
                                </label>
                            </div>
                            @error('imagenes.*')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Preview de Imágenes -->
                        <div x-show="files.length > 0" class="mt-6">
                            <p class="text-sm font-semibold text-gray-700 mb-4 flex items-center">
                                <i class="fas fa-eye mr-2 text-blue-600"></i>
                                Vista Previa (<span x-text="files.length"></span> imagen<span x-show="files.length !== 1">es</span>)
                            </p>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                <template x-for="(file, index) in files" :key="index">
                                    <div class="relative group">
                                        <img :src="file.url" 
                                             :alt="file.name"
                                             class="w-full h-32 object-cover border-2 border-gray-200">
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
                                class="flex-1 inline-flex items-center justify-center px-8 py-4 text-white font-bold text-lg shadow-lg hover:shadow-xl transition-all duration-300"
                                style="background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%);">
                            <i class="fas fa-save mr-2"></i>
                            Crear Paquete
                        </button>
                        <a href="{{ route('vacaciones.index') }}" 
                           class="flex-1 inline-flex items-center justify-center px-8 py-4 border-2 border-gray-300 text-gray-700 font-bold hover:bg-gray-50 transition-all duration-300 text-lg">
                            <i class="fas fa-times mr-2"></i>
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>

            <!-- Información de Ayuda -->
            <div class="mt-6 bg-blue-50 p-8 border border-blue-200">
                <h4 class="font-bold text-gray-900 mb-4 flex items-center text-lg">
                    <i class="fas fa-lightbulb mr-2 text-blue-600"></i>
                    Consejos para crear un buen paquete
                </h4>
                <ul class="space-y-3 text-gray-700">
                    <li class="flex items-start">
                        <i class="fas fa-check-circle mr-3 mt-0.5 text-blue-600"></i>
                        <span>Usa un título descriptivo y atractivo que capture la esencia del viaje</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle mr-3 mt-0.5 text-blue-600"></i>
                        <span>Incluye detalles importantes en la descripción: qué incluye, duración, actividades</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle mr-3 mt-0.5 text-blue-600"></i>
                        <span>Sube imágenes de alta calidad que muestren los mejores aspectos del destino</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle mr-3 mt-0.5 text-blue-600"></i>
                        <span>Establece un precio competitivo y realista</span>
                    </li>
                </ul>
            </div>
        </div>
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
    </script>
</x-app-layout>