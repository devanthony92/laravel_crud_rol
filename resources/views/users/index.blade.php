<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-gray-800 flex items-center gap-2">
            <i class="fa-solid fa-users text-indigo-600"></i>
            Gestión de Usuarios
        </h1>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto sm:px-6 lg:px-8">

        {{-- ✅ Mensaje de éxito --}}
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg shadow-sm">
                <i class="fa-solid fa-circle-check mr-2"></i>
                {{ session('success') }}
            </div>
        @endif

        {{-- ✅ Botón crear usuario --}}
        @can('create users')
            @if (Route::has('users.create'))
                <div class="mb-5 flex justify-end">
                    <a href="{{ route('users.create') }}"
                        class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2.5 px-5 rounded-xl shadow-md transition-all duration-200">
                        <i class="fa-solid fa-user-plus"></i>
                        Nuevo Usuario
                    </a>
                </div>
            @else
                <p class="text-red-500 text-sm">Ruta 'users.create' no está disponible.</p>
            @endif
        @endcan

        {{-- ✅ Tabla responsive --}}
        <div class="overflow-x-auto bg-white shadow-lg rounded-xl border border-gray-100">
            <table class="w-full text-sm text-left text-gray-700">
                <thead class="bg-gray-100 text-gray-800 uppercase text-xs font-semibold tracking-wider">
                    <tr>
                        <th class="px-6 py-3">ID</th>
                        <th class="px-6 py-3">Nombre</th>
                        <th class="px-6 py-3">Email</th>
                        <th class="px-6 py-3">Roles</th>
                        <th class="px-6 py-3 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr
                            class="border-t hover:bg-indigo-50 transition-colors duration-200 {{ $loop->even ? 'bg-gray-50' : 'bg-white' }}">
                            <td class="px-6 py-3">{{ $user->id }}</td>
                            <td class="px-6 py-3 font-medium text-gray-900">{{ $user->name }}</td>
                            <td class="px-6 py-3">{{ $user->email }}</td>
                            <td class="px-6 py-3">
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($user->roles as $role)
                                        <span
                                            class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full 
                                            {{ $role->name === 'admin' ? 'bg-indigo-100 text-indigo-700' : 'bg-gray-100 text-gray-700' }}">
                                            <i class="fa-solid fa-shield-halved mr-1"></i>{{ $role->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-6 py-3 text-center space-x-3">

                                {{-- 👁 Mostrar --}}
                                <a href="{{ route('users.show', $user) }}"
                                    class="text-indigo-600 hover:text-indigo-800 transition"
                                    title="Ver detalles">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                {{-- ✏️ Editar --}}
                                @can('edit users')
                                    <a href="{{ route('users.edit', $user) }}"
                                        class="text-yellow-500 hover:text-yellow-600 transition"
                                        title="Editar usuario">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                @endcan

                                {{-- 🗑 Eliminar --}}
                                @can('delete users')
                                    <form action="{{ route('users.destroy', $user) }}" method="POST"
                                        class="inline-block"
                                        onsubmit="return confirm('¿Seguro que deseas eliminar este usuario?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 hover:text-red-800 transition"
                                            title="Eliminar usuario">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-6 text-center text-gray-500">
                                <i class="fa-solid fa-user-slash text-gray-400 text-3xl mb-2"></i>
                                <p>No hay usuarios registrados.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- ✅ Paginación --}}
        <div class="mt-6 flex justify-center">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>
