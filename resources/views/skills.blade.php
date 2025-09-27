@extends('layouts.app')

@section('title', 'Habilidades')

@section('content')
<div class="container mx-auto px-4 py--2">
    <h1 class="text-5xl font-extrabold mb-12 text-center text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 drop-shadow-lg">
        Habilidades
    </h1>

    <!-- Carrusel -->
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            @foreach($skills as $skill)
                <div class="swiper-slide">
                    <div class="skill-card bg-gradient-to-br from-white/90 to-gray-100/80 backdrop-blur-lg
                                shadow-lg rounded-2xl p-6 border border-gray-200
                                transform transition duration-500 hover:-translate-y-2 hover:shadow-2xl hover:scale-105
                                h-56 flex flex-col justify-center cursor-pointer"
                         data-skill="{{ $skill->id }}">
                        <h2 class="text-xl font-semibold text-gray-800 truncate">{{ $skill->name }}</h2>
                        <p class="text-gray-600 text-sm mt-1 truncate">{{ $skill->level }}</p>

                        @if($skill->proficiency)
                            <div class="w-full bg-gray-200 rounded-full h-2 mt-4">
                                <div class="bg-gradient-to-r from-indigo-500 to-purple-500 h-2 rounded-full transition-all duration-700"
                                    style="width: {{ $skill->proficiency }}%">
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">{{ $skill->proficiency }}% dominio</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Flechas navegación -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>

    <!-- POPUPS (fuera del carrusel) -->
    @foreach($skills as $skill)
        <div id="popup-{{ $skill->id }}"
             class="skill-popup fixed inset-0 hidden items-center justify-center bg-black/60 z-50">
            <div class="popup-inner w-[min(92vw,1000px)] max-h-[90vh] overflow-y-auto rounded-3xl shadow-2xl p-8
                        bg-gradient-to-br from-indigo-600/95 via-purple-600/95 to-pink-600/95 text-white relative animate-border-glow"
                 onmouseenter="swiper.autoplay.stop()"
                 onmouseleave="hidePopup('{{ $skill->id }}')">
                <h3 class="text-2xl font-bold mb-4 drop-shadow-lg">{{ $skill->name }}</h3>
                <p class="text-sm text-gray-200 mb-4 italic">Nivel: {{ $skill->level }}</p>
                <div class="text-base leading-relaxed prose prose-invert">
                    {!! $skill->description ?? 'Sin descripción disponible.' !!}
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- SwiperJS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
    const swiper = new Swiper(".mySwiper", {
        slidesPerView: 1,
        spaceBetween: 20, // espacio entre slides
        loop: true,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        autoplay: {
            delay: 1000, // tiempo en milisegundos
            disableOnInteraction: false,
        },
        breakpoints: {
            640: { slidesPerView: 2 },
            1024: { slidesPerView: 3 },
            1280: { slidesPerView: 4 },
        },
    });

    // Mostrar / ocultar popup
    function showPopup(id) {
        const popup = document.getElementById(`popup-${id}`);
        if (!popup) return;
        popup.classList.remove("hidden");
        popup.classList.add("flex");
        swiper.autoplay.stop();
    }

    function hidePopup(id) {
        const popup = document.getElementById(`popup-${id}`);
        if (!popup) return;
        popup.classList.add("hidden");
        popup.classList.remove("flex");
        swiper.autoplay.start();
    }

    // Hover en card abre popup
    document.querySelectorAll(".skill-card").forEach(card => {
        const id = card.dataset.skill;
        card.addEventListener("mouseenter", () => showPopup(id));
        card.addEventListener("mouseleave", () => {
            setTimeout(() => {
                const popup = document.getElementById(`popup-${id}`);
                if (!popup.matches(":hover")) hidePopup(id);
            }, 120);
        });
    });
</script>

<style>

    /* Scrollbar elegante */
    .popup-inner::-webkit-scrollbar {
        width: 6px;
    }
    .popup-inner::-webkit-scrollbar-thumb {
        background: linear-gradient(to bottom, #6366f1, #a855f7, #ec4899);
        border-radius: 4px;
    }
    .popup-inner::-webkit-scrollbar-track {
        background: transparent;
    }

    /* Borde animado de la flotante */
    @keyframes borderGlow {
        0% { border-color: #6366f1; box-shadow: 0 0 15px #6366f1; }
        50% { border-color: #a855f7; box-shadow: 0 0 20px #a855f7; }
        100% { border-color: #ec4899; box-shadow: 0 0 15px #ec4899; }
    }
    .animate-border-glow {
        animation: borderGlow 4s infinite alternate;
    }

    /* Flechas más afuera */
    .swiper-button-next { right: -40px; }
    .swiper-button-prev { left: -40px; }

    .swiper-button-next,
    .swiper-button-prev {
        color: #9333ea;
        scale: 0.9;
        transition: all 0.3s ease;
    }
    .swiper-button-next:hover,
    .swiper-button-prev:hover {
        color: #ec4899;
        scale: 1;
    }
</style>
@endsection
