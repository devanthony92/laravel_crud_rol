<x-app-layout>
    <div class="mt-16 max-w-3xl mx-auto sm:px-6 lg:px-8">
        {{-- ✅ Encabezado con degradado --}}
        <div class="rounded-xl shadow-sm p-3 bg-gradient-to-r from-indigo-500 to-indigo-700 flex justify-center items-center mb-6">
            <h2 class="text-2xl font-semibold text-white flex items-center gap-2">
                <i class="fa-solid fa-lock"></i> Administrar permisos de rol: 
                <span class="capitalize">{{ $role->name }}</span>
            </h2>
        </div>

        {{-- ✅ Formulario principal --}}
        <form method="POST" action="{{ route('roles.update', $role->id) }}"
              class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-lg border border-gray-100 dark:border-gray-800 transition-transform duration-300 hover:shadow-xl">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="text-lg font-semibold text-indigo-700 dark:text-indigo-400 capitalize mb-3 flex items-center gap-2">Nombre</label>
                <input type="text" name="name" value="{{ $role->name }}" class="w-full border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div class="mb-4">
                <label class="text-lg font-semibold text-indigo-700 dark:text-indigo-400 capitalize mb-3 flex items-center gap-2">Descripción</label>
                <textarea name="description" class="w-full border-gray-300 rounded-md shadow-sm">{{ $role->description }}</textarea>
            </div>

            @foreach ($permissions as $group => $perms)
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
            @endforeach

            {{-- ✅ Botones --}}
            <div class="flex justify-end gap-3">
                <a href="{{ route('roles.index') }}"
                   class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition duration-200">
                    <i class="fa-solid fa-xmark"></i> Cancelar
                </a>

                <button type="submit"
                        class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-200">
                    <i class="fa-solid fa-floppy-disk"></i> Guardar cambios
                </button>
            </div>
        </form>
    </div>
</x-app-layout>

