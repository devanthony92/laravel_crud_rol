<x-app-layout>
    <div class="mt-24 max-w-md mx-auto bg-white/80 dark:bg-gray-900/80 backdrop-blur-lg border border-gray-200 dark:border-gray-700 shadow-xl rounded-2xl p-8 transition-all duration-300">
        
        <!-- Título -->
        <div class="text-center mb-6">
            <h2 class="text-3xl font-bold text-indigo-700 dark:text-indigo-300 flex items-center justify-center gap-2">
                <i class="fa-solid fa-user-shield"></i>
                {{ $role->name }}
            </h2>
            <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Detalles del rol y su descripción</p>
        </div>

        <!-- Descripción -->
        <div class="bg-gray-50 dark:bg-gray-800/60 border border-gray-200 dark:border-gray-700 rounded-xl p-4 mb-6 shadow-inner">
            <p class="text-gray-600 dark:text-gray-300 text-sm">
                <strong class="text-indigo-600 dark:text-indigo-400">Descripción:</strong> 
                {{ $role->description ?? '—' }}
            </p>
        </div>

        <!-- Acciones -->
        <div class="flex justify-center gap-4 mt-6">
            <a href="{{ route('roles.index') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg font-medium text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 border border-gray-300 dark:border-gray-700 transition-all duration-200">
                <i class="fa-solid fa-arrow-left"></i>
                Volver
            </a>

            <a href="{{ route('roles.edit', $role) }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg font-medium text-white bg-indigo-600 hover:bg-indigo-700 shadow-md hover:shadow-lg transition-all duration-200">
                <i class="fa-solid fa-pen-to-square"></i>
                Editar
            </a>
        </div>
    </div>
</x-app-layout>
