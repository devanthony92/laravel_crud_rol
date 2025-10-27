<x-app-layout>
    <div class="mt-16 max-w-3xl mx-auto sm:px-6 lg:px-8">
        
        {{-- ✅ Encabezado principal --}}
        <div class="rounded-xl shadow-sm p-3 bg-gradient-to-r from-indigo-500 to-indigo-700 flex justify-center items-center mb-6">
            <h2 class="text-2xl font-semibold text-white flex items-center gap-2">
                <i class="fa-solid fa-user-shield"></i> 
                Rol: <span class="capitalize">{{ $role->name }}</span>
            </h2>
        </div>

        {{-- ✅ Detalles del rol --}}
        <div class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-lg border border-gray-100 dark:border-gray-800 transition-all duration-300">
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-indigo-700 dark:text-indigo-400 flex items-center gap-2 mb-2">
                    <i class="fa-solid fa-circle-info"></i>
                    Información del rol
                </h3>
                <p class="text-gray-700 dark:text-gray-300">
                    <strong class="text-indigo-600 dark:text-indigo-400">Descripción:</strong> 
                    {{ $role->description ?? 'Sin descripción disponible' }}
                </p>
                <p class="text-gray-700 dark:text-gray-300 mt-1">
                    <strong class="text-indigo-600 dark:text-indigo-400">Guard name:</strong> {{ $role->guard_name }}
                </p>
            </div>

            {{-- ✅ Permisos asignados --}}
            <div>
                <h3 class="text-lg font-semibold text-indigo-700 dark:text-indigo-400 flex items-center gap-2 mb-4">
                    <i class="fa-solid fa-key"></i>
                    Permisos asignados
                </h3>

                @forelse ($permissions as $group => $perms)
                    <div class="mb-6 p-4 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm hover:shadow-md transition">
                        <h3 class="text-lg font-semibold text-indigo-700 dark:text-indigo-400 capitalize mb-3 flex items-center gap-2">
                            <i class="fa-solid fa-layer-group"></i>
                            {{ str_replace('_', ' ', $group) }}
                        </h3>

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2">
                            @foreach ($perms as $permission)
                                <label class="flex items-center gap-2 text-gray-700 dark:text-gray-200 cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-800 rounded-md px-2 py-1 transition">
                                    <input type="checkbox" 
                                        name="permissions[]" 
                                        value="{{ $permission->name }}"
                                        {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}
                                        class="rounded text-indigo-600 focus:ring-indigo-500">
                                    <span>{{ ucfirst($permission->name) }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 dark:text-gray-400 italic">Este rol no tiene permisos asignados.</p>
                @endforelse
            </div>

            {{-- ✅ Acciones --}}
            <div class="flex justify-center gap-4 mt-8">
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
    </div>
</x-app-layout>
