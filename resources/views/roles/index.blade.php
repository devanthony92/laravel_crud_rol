<x-app-layout>
    
    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8  animate__animated animate__fadeInDown">
        {{-- Mensaje de éxito --}}
        @if (session('success'))
            <div class=" mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded shadow-sm">
                <p class="font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <div class="flex justify-between mb-6">
            <h2 class="text-2xl font-bold leading-tight text-gray-800">
                🛡️ Roles
            </h2>
            @can('manage roles')
                <a href="{{ route('roles.create') }}"
                    class="inline-flex items-center gap-2 bg-gradient-to-r from-indigo-600 to-blue-500 hover:from-indigo-700 hover:to-blue-600 text-white font-semibold py-2 px-5 rounded-lg shadow-lg transition-transform transform hover:scale-105">
                    <i class="fa-solid fa-plus"></i> Nuevo Rol
                </a>
            @endcan
        </div>
    <div class="hidden md:block overflow-x-auto bg-white shadow-lg rounded-xl border border-gray-100">
        <table class="min-w-full border-collapse">
            <thead class="bg-gradient-to-r from-indigo-100 to-blue-100 text-gray-800">
                <tr class="bg-gray-100 text-gray-700">
                    <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Nombre</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Descripción</th>
                    <th class="px-6 py-3 text-center text-sm font-semibold uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach($roles as $role)
                    <tr class="border-t">
                        <td class="p-2">{{ $role->id }}</td>
                        <td class="p-2">{{ $role->name }}</td>
                        <td class="p-2">{{ $role->description ?? '—' }}</td>
                        <td class="p-2 flex justify-center gap-2">
                            <a href="{{ route('roles.show', $role) }}" class="text-blue-500 hover:text-blue-700"><i class="fa-solid fa-eye"></i></a>
                            <a href="{{ route('roles.edit', $role) }}" class="text-yellow-500 hover:text-yellow-700"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form action="{{ route('roles.destroy', $role) }}" method="POST" onsubmit="return confirm('¿Eliminar este rol?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">{{ $roles->links() }}</div>
    </div>
</x-app-layout>
