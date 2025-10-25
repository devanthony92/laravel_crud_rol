<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos y Usuarios</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">

    <!-- HERO PRINCIPAL -->
    <section class="relative min-h-screen flex flex-col justify-center items-center text-center bg-gradient-to-r from-indigo-600 to-blue-500 text-white overflow-hidden">
        <div class="relative z-10 px-6">
            <h1 class="text-4xl md:text-6xl font-extrabold mb-6 animate__animated animate__fadeInDown">
                Plataforma de Gestión de Productos y Usuarios
            </h1>
            <p class="text-lg md:text-xl text-gray-100 mb-8 max-w-2xl mx-auto animate__animated animate__fadeInUp animate__delay-1s">
                Administra tu inventario, controla roles y permisos, y gestiona usuarios de manera eficiente con Laravel.
            </p>
            <div class="flex justify-center gap-4 animate__animated animate__fadeInUp animate__delay-2s">
                <a href="{{ route('login') }}" 
                   class="bg-white text-indigo-700 px-6 py-3 rounded-full font-semibold hover:bg-gray-100 transition duration-300">
                   Iniciar Sesión
                </a>
                
            </div>
        </div>

        <!-- Ondas decorativas -->
        <div class="absolute bottom-0 left-0 w-[200%] overflow-hidden leading-none">
            <svg class="relative block h-32 w-[200%] animate-wave" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,0V46.29c47.74,22,103.15,29,158,17.39,70.77-15.41,136.71-57.26,207.48-71.55C438.67-20.5,512,9.92,583.08,31.09,655.43,52.77,726.54,65.56,798,51.12c70.63-14.21,140.14-54.13,210.77-66.68,69.9-12.35,141.19,2.36,191.23,20.49V0Z" fill="#ffffff" fill-opacity="0.3"/>
            </svg>
        </div>
    </section>
    <!-- FOOTER -->
    <footer class="bg-gray-900 text-gray-400 py-8 text-center py-3">
        <p>&copy; {{ date('Y') }} Desarrollado por <span class="text-white font-semibold">Anthony Martínez</span></p>
        <div class="mt-2 flex justify-center gap-6">
            <a href="https://github.com/devanthony92" target="_blank" class="hover:text-white transition">GitHub</a>
            <a href="https://linkedin.com/in/anthony-martinez-amell" target="_blank" class="hover:text-white transition">LinkedIn</a>
            <a href="mailto:antmarame@gmail.com" class="hover:text-white transition">Contacto</a>
        </div>
    </footer>

</body>
</html>
