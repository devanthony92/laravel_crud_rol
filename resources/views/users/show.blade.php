<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-800 flex items-center gap-2">
            <i class="fa-solid fa-user text-indigo-600"></i>
            Detalle del Usuario
        </h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-lg rounded-xl p-6 border border-gray-100 transition-transform duration-300 hover:shadow-xl">
            
            {{-- ✅ Nombre principal --}}
            <h3 class="text-3xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-id-card text-indigo-500"></i>
                {{ $user->name }}
            </h3>

            {{-- ✅ Información básica --}}
            <div class="space-y-3 text-gray-700 text-base">
                <p>
                    <strong class="text-gray-900"><i class="fa-solid fa-envelope mr-2 text-indigo-500"></i>Email:</strong>
                    {{ $user->email }}
                </p>

                <p>
                    <strong class="text-gray-900"><i class="fa-solid fa-user-shield mr-2 text-indigo-500"></i>Rol:</strong>
                    <span class="inline-flex flex-wrap gap-2">
                        @foreach ($user->roles as $role)
                            <span
                                class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full 
                                {{ $role->name === 'admin' ? 'bg-indigo-100 text-indigo-700' : 'bg-gray-100 text-gray-700' }}">
                                <i class="fa-solid fa-shield-halved mr-1"></i>{{ ucfirst($role->name) }}
                            </span>
                        @endforeach
                    </span>
                </p>

                <p>
                    <strong class="text-gray-900"><i class="fa-solid fa-toggle-on mr-2 text-indigo-500"></i>Estado:</strong>
                    @if ($user->deleted_at)
                        <span class="text-red-600 font-semibold">Eliminado</span>
                    @else
                        <span class="text-green-600 font-semibold">Activo</span>
                    @endif
                </p>
            </div>

            {{-- ✅ Acciones --}}
            <div class="mt-8 flex flex-col sm:flex-row gap-3 justify-center sm:justify-end">
                <a href="{{ route('users.index') }}"
                   class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition duration-200">
                    <i class="fa-solid fa-arrow-left"></i> Volver
                </a>

                @can('edit users')
                    <a href="{{ route('users.edit', $user) }}"
                       class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-200">
                        <i class="fa-solid fa-pen-to-square"></i> Editar
                    </a>
                @endcan
            </div>
        </div>
    </div>
</x-app-layout>
