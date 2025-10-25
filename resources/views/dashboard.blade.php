<x-app-layout>
<!-- DASHBOARD PREVIEW -->
<section id="preview" class="relative bg-white py-24 overflow-hidden">
    <div class="max-w-6xl mx-auto px-6 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-12 animate__animated animate__fadeInDown">
            Vista Previa del Panel de Administración
        </h2>
        <p class="text-gray-600 max-w-2xl mx-auto mb-16 animate__animated animate__fadeInUp animate__delay-1s">
            Una interfaz moderna y responsiva para gestionar productos, usuarios y permisos en tiempo real.
        </p>
      

        <!-- Mockup estilo dashboard -->
<div class="relative bg-gray-100 shadow-2xl rounded-2xl overflow-hidden max-w-5xl mx-auto animate__animated animate__zoomIn animate__delay-2s">

    <!-- Navbar superior -->
    <nav x-data="{ open: false }" class="bg-indigo-600 text-white">
        <div class="flex justify-between items-center px-6 py-3">
            <!-- Izquierda: título -->
            <h3 class="font-semibold text-lg">Dashboard</h3>

            <!-- Centro: menú principal -->
            <ul class="hidden md:flex space-x-6 font-medium">
                <li class="hover:text-yellow-300 transition cursor-pointer">🏠 Inicio</li>
                <li class="hover:text-yellow-300 transition cursor-pointer">📦 Productos</li>
                <li class="hover:text-yellow-300 transition cursor-pointer">👥 Usuarios</li>
                <li class="hover:text-yellow-300 transition cursor-pointer">⚙️ Roles</li>
                <li class="hover:text-yellow-300 transition cursor-pointer">📊 Reportes</li>
            </ul>

            <!-- Derecha: íconos de estado -->
            <div class="flex gap-3 items-center">
                <span class="w-3 h-3 bg-green-400 rounded-full"></span>
                <span class="w-3 h-3 bg-yellow-400 rounded-full"></span>
                <span class="w-3 h-3 bg-red-400 rounded-full"></span>

                <!-- Botón móvil -->
                <button @click="open = !open" class="md:hidden focus:outline-none ml-3">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Menú móvil -->
        <div x-show="open" class="md:hidden bg-indigo-700 px-6 py-3 space-y-2 animate__animated animate__fadeInDown">
            <ul class="space-y-2 font-medium">
                <li class="hover:text-yellow-300 transition cursor-pointer">🏠 Inicio</li>
                <li class="hover:text-yellow-300 transition cursor-pointer">📦 Productos</li>
                <li class="hover:text-yellow-300 transition cursor-pointer">👥 Usuarios</li>
                <li class="hover:text-yellow-300 transition cursor-pointer">⚙️ Roles</li>
                <li class="hover:text-yellow-300 transition cursor-pointer">📊 Reportes</li>
            </ul>
        </div>
    </nav>

    <!-- Contenido principal -->
    <main class="p-8 text-left bg-white">
        <h4 class="text-lg font-semibold mb-4 text-gray-800">Gestión de Productos</h4>

        <!-- Tabla simulada -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 text-sm">
                <thead class="bg-indigo-100">
                    <tr>
                        <th class="py-3 px-4 text-left">ID</th>
                        <th class="py-3 px-4 text-left">Nombre</th>
                        <th class="py-3 px-4 text-left">Categoría</th>
                        <th class="py-3 px-4 text-left">Stock</th>
                        <th class="py-3 px-4 text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-t hover:bg-gray-50">
                        <td class="py-2 px-4">1</td>
                        <td class="py-2 px-4">Laptop Lenovo</td>
                        <td class="py-2 px-4">Tecnología</td>
                        <td class="py-2 px-4">23</td>
                        <td class="py-2 px-4 text-indigo-600 font-semibold cursor-pointer">Editar</td>
                    </tr>
                    <tr class="border-t hover:bg-gray-50">
                        <td class="py-2 px-4">2</td>
                        <td class="py-2 px-4">Mouse Logitech</td>
                        <td class="py-2 px-4">Accesorios</td>
                        <td class="py-2 px-4">45</td>
                        <td class="py-2 px-4 text-indigo-600 font-semibold cursor-pointer">Editar</td>
                    </tr>
                    <tr class="border-t hover:bg-gray-50">
                        <td class="py-2 px-4">3</td>
                        <td class="py-2 px-4">Monitor Samsung</td>
                        <td class="py-2 px-4">Pantallas</td>
                        <td class="py-2 px-4">12</td>
                        <td class="py-2 px-4 text-indigo-600 font-semibold cursor-pointer">Editar</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Indicadores rápidos -->
        <div class="grid md:grid-cols-3 gap-6 mt-10">
            <div class="bg-indigo-50 rounded-xl p-4 text-center">
                <p class="text-3xl font-bold text-indigo-600">54</p>
                <p class="text-sm text-gray-500">Productos totales</p>
            </div>
            <div class="bg-indigo-50 rounded-xl p-4 text-center">
                <p class="text-3xl font-bold text-indigo-600">12</p>
                <p class="text-sm text-gray-500">Usuarios activos</p>
            </div>
            <div class="bg-indigo-50 rounded-xl p-4 text-center">
                <p class="text-3xl font-bold text-indigo-600">8</p>
                <p class="text-sm text-gray-500">Roles definidos</p>
            </div>
        </div>
    </main>
</div>
    </div>
</section>

</x-app-layout>
