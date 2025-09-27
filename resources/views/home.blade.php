@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<div class="container mx-auto max-w-[125%] px-0.5 pb-0.5">

    <!-- 🔥 Nueva sección de presentación -->
    <section class="hero-section">

        <!-- Foto -->
        <div class="profile-pic">
            <img src="{{ asset('images/profile.jpg') }}" alt="Foto de perfil" class="w-full h-full object-cover">
            <div class="pulse-ring"></div>
        </div>

        <!-- Info personal -->
        <div class="info-container">
            <h2 class="intro-title1">¡Hola, soy <span class="highlight">Deyvis Cruz!</span></h2>
            <p class="intro-text">
                Bienvenido a mi portafolio. Aquí encontrarás mis proyectos, experiencia, educación y más.
                Me apasiona la <span class="font-semibold">tecnología</span>, el <span class="font-semibold">desarrollo web</span> y
                siempre estoy en búsqueda de nuevos retos que impulsen mi crecimiento profesional.
            </p>

            <!-- Datos personales -->
            <div class="personal-data">
                <p><i class="fa-solid fa-user mr-1 text-yellow-300"></i><span class="font-semibold">Nombre:</span> Deyvis Fabiany Cruz Carvajal</p>
                <p><i class="fa-solid fa-cake-candles mr-1 text-pink-400"></i><span class="font-semibold">Edad:</span> 28 años</p>
                <p><i class="fa-solid fa-envelope mr-1 text-green-400"></i><span class="font-semibold">Email:</span> deyvis@example.com</p>
                <p><i class="fa-solid fa-location-dot mr-1 text-red-400"></i><span class="font-semibold">Ubicación:</span> Piedecuesta, Santander, Colombia</p>
                <p><i class="fa-solid fa-location-dot mr-1 text-red-400"></i><span class="font-semibold">Dirección:</span> Calle 7 # 7W-50 Ciudadela del Valle</p>
                <p><i class="fa-solid fa-location-dot mr-1 text-red-400"></i><span class="font-semibold">Barrio:</span> Barro Blanco</p>
            </div>
        </div>
    </section>

<section class="relative flex items-center justify-center text-center mb-16 px-6
               bg-gradient-to-r from-indigo-900 via-purple-800 to-indigo-900
               rounded-2xl shadow-2xl overflow-hidden h-28">

    <!-- ✨ Capa decorativa animada -->
    <div class="absolute inset-0 bg-gradient-to-br from-purple-600/20 to-indigo-500/20 animate-pulse"></div>

    <!-- Contenido -->
    <div class="relative z-10 max-w-4xl mx-auto">
        <h1 class="text-3xl md:text-4xl font-extrabold text-white drop-shadow-lg tracking-tight animate-fadeIn">
            Bienvenido a mi <span class="text-yellow-400">Portafolio</span>
        </h1>
        <p class="mt-1 text-md md:text-lg text-gray-200 animate-fadeIn delay-200">
            Explora mis proyectos, experiencia, educación y más.
        </p>
    </div>
</section>



    <section class="grid grid-cols-1 md:grid-cols-3 gap-8">
    <a href="{{ route('projects') }}" class="card-3d" style="background-image: url('{{ asset('images/projects-bg.jpg') }}');">
        <div class="overlay"></div>
        <div class="card-content">
            <h2>Proyectos</h2>
            <p>Mira los proyectos en los que he trabajado.</p>
        </div>
    </a>

    <a href="{{ route('experience') }}" class="card-3d" style="background-image: url('{{ asset('images/experience-bg.jpg') }}');">
        <div class="overlay"></div>
        <div class="card-content">
            <h2>Experiencia</h2>
            <p>Conoce mi trayectoria profesional.</p>
        </div>
    </a>

    <a href="{{ route('education') }}" class="card-3d" style="background-image: url('{{ asset('images/education-bg.jpg') }}');">
        <div class="overlay"></div>
        <div class="card-content">
            <h2>Educación</h2>
            <p>Mis estudios y formación académica.</p>
        </div>
    </a>
</section>
</div>

{{-- 🔹 Estilos personalizados --}}
<style>

    .text-center.mb-16 {
        color: #fff;
    }
    .hero-section {
        min-height: 5vh; /* Altura mínima */
        display: flex; /* Cambia a flexbox */
        flex-direction: column; /* Cambia a columna */
        align-items: center; /* Centra horizontalmente */
        justify-content: center;  /* Centra verticalmente */
        background: #fff; /* Degradado vibrante */
        color: #000000; /* Texto negro */
        border-radius: 1rem; /* Bordes redondeados */
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        padding: 1rem; /* Aumenta el relleno */
        margin-bottom: 0.5rem; /* Espacio inferior */
        margin-top: -1.5rem; /* antes no tenía, ahora queda más pegado */
        font-weight: 400; /* Negrita */
            }

    @media (min-width: 768px) { /* Pantallas medianas y más grandes */
        .hero-section {
            flex-direction: row; /* Cambia a fila en pantallas más grandes */
            text-align: left; /* Alinea el texto a la izquierda */
        }
    }

    .profile-pic {
        position: relative;
        width: 2rem; /* Ancho */
        height: 2rem; /* Alto */
        border-radius: 50%; /* Bordes redondeados */
        overflow: hidden; /* Recorta la imagen */
        border: 4px solid #fff; /* Borde blanco */
        box-shadow: 0 6px 15px rgba(2,2,2,2.5); /* Sombra */
        margin-bottom: 0.5rem; /* Espacio inferior */
        margin-right: 4rem; /* Espacio a la derecha */
        margin-left: -3rem; /* Espacio a la izquierda */
    }

    @media (min-width: 768px) {
        .profile-pic {
            width: 12rem;
            height: 12rem;
            margin-bottom: 0;
        }
    }

    .pulse-ring {
        position: absolute;
        inset: 0; /* Ocupa todo el contenedor */
        border-radius: 50%; /* Bordes redondeados */
        border: 5px solid #FFFACD; /* Borde amarillo claro */
        animation: pulse 2s infinite; /* Animación de pulso */
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.1); opacity: 0.6; }
    }

    .info-container {
    max-width: 100%; /* ✅ Ocupa más espacio horizontal */
    flex: 1; /* ✅ Se adapta al espacio disponible */

}
    @media (min-width: 768px) {
        .info-container {
            max-width: 70%; /* Limita el ancho en pantallas más grandes */
        }
    }
@keyframes fadeIn {
    0% { opacity: 0; transform: translateY(10px); }
    100% { opacity: 1; transform: translateY(0); }

}
@keyframes slideUp {
    from { opacity: 0; transform: translateY(40px); }
    to { opacity: 1; transform: translateY(0); }
}

.animate-fadeIn {
    animation: fadeIn 1s ease forwards;
}
.animate-fadeIn.delay-200 {
    animation-delay: 0.2s;
}
.animate-slide-up {
    animation: slideUp 1.5s ease forwards;
}
.intro-title1 {
        font-size: 2rem; /* Tamaño de fuente */
        font-weight: 800; /* Negrita */
        margin-top: -1rem; /* Sin margen superior */
        margin-bottom: 0.5rem; /* Espacio inferior */
        color: #AFEEEE; /* Texto blanco */
        text-shadow: 1px 1px 2px #000000; /* Sombra azul oscuro para contorno */
        margin-left: -3rem; /* Espacio inferior */
}
    .highlight {
        color: #9f7aea; /* Texto blanco */
    }

    .intro-text {
        margin-top: 1rem; /* Espacio superior */
        font-size: 1.125rem; /* Tamaño de fuente */
        color: #000000; /* Texto negro */
        text-align: justify; /* Justifica el texto */
        margin-left: -3rem; /* Espacio inferior */
    }

    .personal-data {
        display: grid; /* Usa grid para mejor alineación */
        grid-template-columns: 1fr 1fr; /* Dos columnas */
        gap: 1rem; /* Espacio entre filas y columnas */
        margin-top: 1.5rem; /* Espacio superior */
        background: rgba(255, 255, 255, 0.1); /* Fondo semitransparente */
        backdrop-filter: blur(6px); /* Efecto de desenfoque */
        border-radius: 0.75rem; /* Bordes redondeados */
        padding: 0.5rem; /* Relleno */
        box-shadow: 0 4px 12px rgba(0,0,0,0.2); /* Sombra */
        margin-left: -3rem; /* Espacio inferior */
    }

    @media (min-width: 768px) {
        .personal-data {
            grid-template-columns: 1fr 1fr; /* Dos columnas en pantallas maduras */
        }
    }
    /* ==== Cards con efecto 3D dinámico ==== */
    .card-3d {
        position: relative;
        display: flex;
        align-items: flex-end;
        justify-content: center;
        height: 260px;
        border-radius: 1rem;
        background-size: cover;
        background-position: center;
        color: #fff;
        overflow: hidden;
        text-decoration: none;
        box-shadow: 0 10px 25px rgba(0,0,0,1);
        cursor: pointer;
        transition: transform 0.4s ease, box-shadow 0.4s ease;
        perspective: 1000px;
        border: 2px solid rgba(255,255,255,0.6);
        margin-top: -3rem; margin-bottom: -1rem;

    }

    .card-3d .card-content {
        position: relative;
        z-index: 1;
        transform: translateZ(40px);}
    .card-3d .overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.8), rgba(0,0,0,0.2));
        z-index: 0;
    }

    .card-content {
        position: relative;
        padding: 1.5rem;
        text-align: center;
        z-index: 1;
        transform: translateZ(40px);
    }

    .card-content h2 {
        font-size: 1.5rem;
        font-weight: 900;
        text-shadow: 3px 3px 10px rgba(0,0,0,0.9);
        margin-bottom: 0.5rem;
    }

    .card-content p {
        font-size: 0.8rem;
        font-weight: 500;
        text-shadow: 2px 2px 6px rgba(0,0,0,0.8);
    }

    /* 🔥 Efecto 3D al hover */
    .card-3d:hover {
        transform: translateY(-15px) rotateX(10deg) rotateY(-8deg) scale(1.05);
        box-shadow: 0 20px 50px rgba(0,0,0,0.7);
        border: 2px solid #fff; /* Borde más brillante al pasar el mouse */
}
</style>

{{-- 🔹 Script para efecto tilt dinámico --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.7.0/vanilla-tilt.min.js"></script>
<script>
    VanillaTilt.init(document.querySelectorAll(".card-3d"), {
        max: 15,
        speed: 400,
        scale: 1.05,
        glare: true,
        "max-glare": 0.3,
        perspective: 1000
    });
</script>
@endsection
