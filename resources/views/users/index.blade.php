<x-app-layout>
    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8  animate__animated animate__fadeInDown">
        {{-- ✅ Mensaje de éxito --}}
        @if (session('success'))
            <div class=" mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded shadow-sm">
                <i class="fa-solid fa-circle-check mr-2"></i>
                <p class="font-medium">{{ session('success') }}</p>
            </div>
        @endif

        {{-- ✅ Botón crear usuario --}}
        <div class="flex justify-between mb-6">
            <h2 class="text-2xl font-bold leading-tight text-gray-800">
                <i class="fa-solid fa-users text-indigo-600"></i>
                {{ __('Gestión de Usuarios') }}
            </h2>
            @can('create users')            
                    <a href="{{ route('users.create') }}"
                    class="inline-flex items-center gap-2 bg-gradient-to-r from-indigo-600 to-blue-500 hover:from-indigo-700 hover:to-blue-600 text-white font-semibold py-2 px-5 rounded-lg shadow-lg transition-transform transform hover:scale-105">
                        <i class="fa-solid fa-user-plus"></i>
                        Nuevo Usuario
                    </a>
                </div>
            @endcan

        {{-- ✅ Tabla responsive --}}
        <div class="hidden md:block overflow-x-auto bg-white shadow-lg rounded-xl border border-gray-100">
            <table class="min-w-full border-collapse">
                <thead class="bg-gradient-to-r from-indigo-100 to-blue-100 text-gray-800">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Nombre</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Roles</th>
                        <th class="px-6 py-3 text-center text-sm font-semibold uppercase tracking-wider">Acciones</th>
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
