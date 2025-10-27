<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold leading-tight text-gray-800 animate__animated animate__fadeInDown">
            👤 {{ __('Perfil') }}
        </h2>
    </x-slot>

    <div class="py-10 max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6 animate__animated animate__fadeInUp">

        {{-- Información del Perfil --}}

        @can('edit users') 
        <form action="{{ route('profile.update') }}" method="POST"
              class="bg-white border border-gray-100 shadow-xl rounded-2xl overflow-hidden transition-transform transform hover:scale-[1.01]">
            @csrf
            @method('PUT')

            <div class="bg-gradient-to-r from-indigo-600 to-blue-500 px-6 py-4 text-white flex justify-between items-center">
                <h3 class="text-2xl font-semibold">Actualizar Información</h3>
            </div>

            <div class="p-6 space-y-5">
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 uppercase">Nombre</label>
                    <input type="text" name="name" id="name"
                           value="{{ old('name', auth()->user()->name) }}"
                           class="mt-2 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition"
                           required>
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 uppercase">Email</label>
                    <input type="email" name="email" id="email"
                           value="{{ old('email', auth()->user()->email) }}"
                           class="mt-2 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition"
                           required>
                </div>
            </div>
            
            <div class="bg-gray-50 border-t border-gray-100 px-6 py-4 flex flex-col sm:flex-row justify-end gap-3">
                <button type="submit"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    <i class="fa-solid fa-floppy-disk"></i> Guardar
                </button>
            </div>
        </form>
        
        {{-- Cambiar Contraseña --}}
        <form action="{{ route('password.update') }}" method="POST"
              class="bg-white border border-gray-100 shadow-xl rounded-2xl overflow-hidden transition-transform transform hover:scale-[1.01]">
            @csrf
            @method('PUT')

            <div class="bg-gradient-to-r from-indigo-600 to-blue-500 px-6 py-4 text-white flex justify-between items-center">
                <h3 class="text-2xl font-semibold">Cambiar Contraseña</h3>
            </div>

            <div class="p-6 space-y-5">
                <div>
                    <label for="current_password" class="block text-sm font-semibold text-gray-700 uppercase">Contraseña Actual</label>
                    <input type="password" name="current_password" id="current_password"
                           class="mt-2 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition"
                           required>
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 uppercase">Nueva Contraseña</label>
                    <input type="password" name="password" id="password"
                           class="mt-2 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition"
                           required>
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 uppercase">Confirmar Contraseña</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                           class="mt-2 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition"
                           required>
                </div>
            </div>

            <div class="bg-gray-50 border-t border-gray-100 px-6 py-4 flex flex-col sm:flex-row justify-end gap-3">
                <button type="submit"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    <i class="fa-solid fa-floppy-disk"></i> Guardar
                </button>
            </div>
        </form>
        @else 
        <div class="bg-white border border-gray-100 shadow-xl rounded-2xl overflow-hidden transition-transform transform hover:scale-[1.01]">
            <div class="bg-gradient-to-r from-indigo-600 to-blue-500 px-6 py-4 text-white flex justify-between items-center">
                <h3 class="text-2xl font-semibold">Información del Perfil</h3>
            </div>

            <div class="p-6 space-y-5">
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 uppercase">Nombre</label>
                    <input type="text" id="name"
                        value="{{ auth()->user()->name }}"
                        readonly
                        class="mt-2 w-full rounded-lg border-gray-300 bg-gray-100 text-gray-600 cursor-not-allowed focus:outline-none focus:ring-0 transition">
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 uppercase">Email</label>
                    <input type="email" id="email"
                        value="{{ auth()->user()->email }}"
                        readonly
                        class="mt-2 w-full rounded-lg border-gray-300 bg-gray-100 text-gray-600 cursor-not-allowed focus:outline-none focus:ring-0 transition">
                </div>
            </div>
            <div class="bg-gray-50 border-t border-gray-100 px-6 py-4 text-right text-sm text-gray-500">
                <span>Solo lectura. Para editar, contacta al administrador.</span>
            </div>
        </div>
        @endcan

    </div>
</x-app-layout>
