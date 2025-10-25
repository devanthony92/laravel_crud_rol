<x-guest-layout>
    <div class="mt-16 py-6 max-w-md mx-auto sm:px-6 lg:px-8">

        {{-- ✅ Encabezado con degradado Indigo --}}
        <div class="rounded-xl shadow-sm p-3 bg-gradient-to-r from-indigo-500 to-indigo-700 flex justify-center items-center mb-6">
            <h2 class="text-2xl font-semibold text-white flex items-center gap-2">
                <i class="fa-solid fa-right-to-bracket"></i> Iniciar sesión
            </h2>
        </div>

        {{-- ✅ Mensaje de estado --}}
        <x-auth-session-status class="mb-4" :status="session('status')" />

        {{-- ✅ Formulario principal --}}
        <form method="POST" action="{{ route('login') }}"
              class="bg-gray-50 dark:bg-gray-900/90 p-6 rounded-xl shadow-2xl border border-gray-200 dark:border-gray-700 transition-transform duration-300 hover:shadow-indigo-200/50">
            @csrf

            {{-- Email --}}
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-800 dark:text-gray-300">Correo electrónico</label>
                <div class="relative">
                    <i class="fa-solid fa-envelope absolute left-3 top-3 text-indigo-600 dark:text-indigo-400"></i>
                    <input id="email" 
                           type="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required autofocus autocomplete="username"
                           class="mt-1 w-full border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded-md shadow-sm pl-10 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
            </div>

            {{-- Contraseña --}}
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-800 dark:text-gray-300">Contraseña</label>
                <div class="relative">
                    <i class="fa-solid fa-lock absolute left-3 top-3 text-indigo-600 dark:text-indigo-400"></i>
                    <input id="password" 
                           type="password" 
                           name="password" 
                           required autocomplete="current-password"
                           class="mt-1 w-full border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded-md shadow-sm pl-10 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
            </div>

            {{-- Recordarme + enlace --}}
            <div class="flex items-center justify-between mb-6">
                <label for="remember_me" class="flex items-center cursor-pointer">
                    <input id="remember_me" type="checkbox" name="remember"
                           class="h-4 w-4 text-indigo-600 border-gray-300 dark:border-gray-600 focus:ring-indigo-500 rounded">
                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Recordarme</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline"
                       href="{{ route('password.request') }}">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif
            </div>

            {{-- Botón --}}
            <div class="flex justify-end">
                <button type="submit" 
                        class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition duration-200 shadow-md hover:shadow-lg">
                    <i class="fa-solid fa-arrow-right-to-bracket"></i> Ingresar
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>

