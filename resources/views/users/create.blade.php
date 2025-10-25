<x-app-layout>
    <div class="mt-16 py-6 max-w-md mx-auto sm:px-6 lg:px-8">
        
        {{-- ✅ Encabezado con degradado --}}
        <div class="rounded-xl shadow-sm p-3 bg-gradient-to-r from-cyan-500 to-blue-500 flex justify-center items-center mb-6">
            <h2 class="text-2xl font-semibold text-white flex items-center gap-2">
                <i class="fa-solid fa-user-plus"></i> Crear nuevo usuario
            </h2>
        </div>

        {{-- ✅ Formulario principal --}}
        <form action="{{ route('users.store') }}" method="POST"
              class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 transition-transform duration-300 hover:shadow-xl">
            @csrf

            {{-- Nombre --}}
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                <div class="relative">
                    <i class="fa-solid fa-user absolute left-3 top-3 text-gray-400"></i>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           value="{{ old('name') }}"
                           class="mt-1 w-full border-gray-300 rounded-md shadow-sm pl-10 focus:ring-cyan-500 focus:border-cyan-500" 
                           required>
                </div>
                @error('name') 
                    <span class="text-red-500 text-sm">{{ $message }}</span> 
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Correo</label>
                <div class="relative">
                    <i class="fa-solid fa-envelope absolute left-3 top-3 text-gray-400"></i>
                    <input type="email" 
                           name="email" 
                           id="email" 
                           value="{{ old('email') }}"
                           class="mt-1 w-full border-gray-300 rounded-md shadow-sm pl-10 focus:ring-cyan-500 focus:border-cyan-500" 
                           required>
                </div>
                @error('email') 
                    <span class="text-red-500 text-sm">{{ $message }}</span> 
                @enderror
            </div>

            {{-- Contraseña --}}
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                <div class="relative">
                    <i class="fa-solid fa-lock absolute left-3 top-3 text-gray-400"></i>
                    <input type="password" 
                           name="password"
                           class="mt-1 w-full border-gray-300 rounded-md shadow-sm pl-10 focus:ring-cyan-500 focus:border-cyan-500"
                           required>
                </div>
                @error('password') 
                    <span class="text-red-500 text-sm">{{ $message }}</span> 
                @enderror
            </div>

            {{-- Confirmar contraseña --}}
            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar contraseña</label>
                <div class="relative">
                    <i class="fa-solid fa-lock-keyhole absolute left-3 top-3 text-gray-400"></i>
                    <input type="password" 
                           name="password_confirmation"
                           class="mt-1 w-full border-gray-300 rounded-md shadow-sm pl-10 focus:ring-cyan-500 focus:border-cyan-500">
                </div>
            </div>

            {{-- Roles --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Selecciona un rol:</label>
                <div class="space-y-1">
                    @foreach($roles as $role)
                        <label class="flex items-center cursor-pointer hover:bg-gray-50 rounded-lg p-1">
                            <input type="radio" 
                                   name="role" 
                                   value="{{ $role->name }}"
                                   class="h-4 w-4 text-cyan-600 border-gray-300 focus:ring-cyan-500">
                            <span class="ml-2 text-sm text-gray-700 capitalize">{{ $role->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- Botones --}}
            <div class="flex flex-col sm:flex-row gap-3 justify-center sm:justify-end">
                <a href="{{ route('users.index') }}" 
                   class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition duration-200">
                    <i class="fa-solid fa-xmark"></i> Cancelar
                </a>

                <button type="submit" 
                        class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-cyan-600 text-white rounded-lg hover:bg-cyan-700 transition duration-200">
                    <i class="fa-solid fa-floppy-disk"></i> Guardar
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
