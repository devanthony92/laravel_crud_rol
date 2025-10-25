<x-app-layout>
    <div class="mt-16 py-6 max-w-md mx-auto sm:px-6 lg:px-8">

        {{-- ✅ Encabezado con degradado Indigo --}}
        <div class="rounded-xl shadow-sm p-3 bg-gradient-to-r from-indigo-500 to-indigo-700 flex justify-center items-center mb-6">
            <h2 class="text-2xl font-semibold text-white flex items-center gap-2">
                <i class="fa-solid fa-user-shield"></i> Crear nuevo rol
            </h2>
        </div>

        {{-- ✅ Formulario principal --}}
        <form method="POST" action="{{ route('roles.store') }}"
              class="bg-gray-50 dark:bg-gray-900/90 backdrop-blur-md p-6 rounded-xl shadow-2xl border border-gray-200 dark:border-gray-700 transition-transform duration-300 hover:shadow-indigo-200/50">
            @csrf

            {{-- Nombre del rol --}}
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-800 dark:text-gray-300 mb-1">
                    <i class="fa-solid fa-id-card-clip text-indigo-600 dark:text-indigo-400 mr-1"></i>
                    Nombre del rol
                </label>
                <input type="text" id="name" name="name"
                       class="w-full border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                       placeholder="Ej: Administrador" required>
            </div>

            {{-- Descripción --}}
            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-800 dark:text-gray-300 mb-1">
                    <i class="fa-solid fa-align-left text-indigo-600 dark:text-indigo-400 mr-1"></i>
                    Descripción
                </label>
                <textarea id="description" name="description" rows="3"
                          class="w-full border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                          placeholder="Describe brevemente el propósito de este rol..."></textarea>
            </div>

            {{-- Botones --}}
            <div class="flex flex-col sm:flex-row justify-center sm:justify-end gap-3">
                <a href="{{ route('roles.index') }}" 
                   class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-100 rounded-lg transition duration-200">
                    <i class="fa-solid fa-xmark"></i> Cancelar
                </a>

                <button type="submit" 
                        class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition duration-200 shadow-md hover:shadow-lg">
                    <i class="fa-solid fa-floppy-disk"></i> Guardar
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
