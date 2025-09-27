<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mi Portafolio')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 font-sans">
    <header class="bg-indigo-700 text-white shadow">
        <div class="container mx-auto flex justify-between items-center p-4">
            <h1 class="text-2xl font-bold">Mi Portafolio</h1>
            <nav class="space-x-4">
                <a href="{{ route('home') }}" class="hover:text-indigo-300">Inicio</a>
                <a href="{{ route('about') }}" class="hover:text-indigo-300">Sobre mí</a>
                <a href="{{ route('projects') }}" class="hover:text-indigo-300">Proyectos</a>
                <a href="{{ route('education') }}" class="hover:text-indigo-300">Educación</a>
                <a href="{{ route('experience') }}" class="hover:text-indigo-300">Experiencia</a>
                <a href="{{ route('skills') }}" class="hover:text-indigo-300">Habilidades</a>
                <a href="{{ route('blog') }}" class="hover:text-indigo-300">Blog</a>
                <a href="{{ route('contact') }}" class="hover:text-indigo-300">Contacto</a>
            </nav>
        </div>
    </header>

    <main class="container mx-auto py-10">
        @yield('content')
    </main>

    <footer class="bg-indigo-700 text-white p-4 mt-10">
        <div class="container mx-auto text-center">
            &copy; {{ date('Y') }} Mi Portafolio. Todos los derechos reservados.
        </div>
    </footer>
</body>
</html>
