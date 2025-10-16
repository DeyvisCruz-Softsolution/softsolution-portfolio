@extends('layouts.app')
@section('title', 'Sobre mí')
@section('content')

<!-- Título principal -->
<div class="text-center">
  <h2 class="text-4xl font-bold mb-4 text-indigo-100 font-montserrat">
    Perfil Profesional: Visión Técnica & Creativa
  </h2>
</div>

<!-- Flipbook -->
<div class="flex justify-center px-4 sm:px-0">
  <div class="book-shell relative w-full max-w-6xl">
    <div id="flipbook" class="mx-auto">

      <!-- Portada -->
      <div class="page cover-page page-with-binding flex flex-col justify-center items-center h-full p-6 text-center" data-aos="zoom-in">
        <h1 class="text-6xl font-bold mb-4 animate-pulse">Soluciones técnicas integrales con impacto visual y profesional</h1>
        <h2 class="text-lg max-w-2xl">Portafolio institucional Técnico integral y desarrollador visual</h2>
        <p class="text-lg max-w-2xl">Explora mi experiencia, habilidades y proyectos como desarrollador web. Descubre mi enfoque en la creación de soluciones tecnológicas innovadoras.</p>
      </div>

      <!-- Páginas dinámicas -->
      @foreach($abouts as $item)
        <div class="page page-with-binding bg-white rounded-lg shadow-xl p-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
          <div class="page-scroll flex flex-col items-center">
            <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title }}"
                 class="mb-4 h-24 w-24 object-cover rounded-full shadow-md border-4 border-indigo-200 transition-transform duration-300 hover:scale-105">
            <h3 class="text-xl font-semibold text-indigo-800 mb-2 text-center">{{ $item->title }}</h3>
            <div class="prose prose-indigo text-sm leading-relaxed text-justify max-w-4xl">
              {!! $item->description !!}
            </div>
          </div>
        </div>
      @endforeach

      <!-- Contraportada -->
      <div class="page page-with-binding bg-white flex flex-col items-center justify-center p-6 text-center" data-aos="fade-up">
        <h2 class="text-2xl font-bold text-indigo-700 mb-4">Gracias por visitar</h2>
        <p class="text-gray-600 max-w-xl">Este flipbook fue desarrollado con Laravel, TailwindCSS y Turn.js para demostrar habilidades técnicas y sensibilidad visual.</p>
      </div>

    </div>

    <!-- Indicador de página -->
    <div id="pageIndicator" class="absolute bottom-4 right-4 text-sm text-gray-500 z-50"></div>
  </div>
</div>

<!-- Sonido -->
<audio id="pageSound" src="{{ asset('sounds/page-flip.mp3') }}"></audio>

<style>
<!-- CSS -->
.book-shell {
  perspective: 2000px;
  margin-bottom: 2rem;
}

#flipbook {
  width: 900px;
  height: 520px;
  transform-style: preserve-3d;
  position: relative;
}

#pageIndicator {
  letter-spacing: 1.5px;
  padding: 6px 10px;
  margin-bottom: 1px;
  margin-right: 60px;
}

.page {
  width: 900px;
  height: 520px;
  padding: 1rem;
  border-radius: 5px;
  box-shadow: 0 8px 16px rgba(0,0,0,0.1);
  background-color: #fff;
  position: relative;
  overflow: visible;
}

.page-scroll {
  height: 460px;
  max-width: 500px;
  overflow-y: auto;
  padding: 1.5rem 2rem;
  font-size: 0.875rem;
  background: white;
  border: 1px solid #e5e7eb;
  box-shadow: inset 0 0 6px rgba(0,0,0,0.05);
  border-radius: 4px;
  position: relative;
  z-index: 2;
}

.page-scroll::-webkit-scrollbar { width: 6px; }
.page-scroll::-webkit-scrollbar-thumb { background-color: #a5b4fc; border-radius: 3px; }

.cover-page {
  background: linear-gradient( to left, #0000ff, #00ff00);
  padding: 1.5rem 2rem;
  box-shadow: inset 0 0 80px rgba(0,1,2,2.1);
  color: black;
  border-radius: 23px;
  position: relative; /* Necesario para el pseudo-elemento */
}
.text-lg.max-w-2xl {
  font-size: 1.125rem;
  max-width: 32rem;
  color: white;
  text-align: center;
}
.cover-page::before {
  content: "";
  position: absolute;
  inset: 0;
  background: rgba(0, 1, 1, 0.2);
  z-index: 0;
  border-radius: 8px;
}
.cover-page > * { position: relative; z-index: 1; }

/* Páginas con anillado dinámico */
.page-with-binding {
  position: relative;
  padding-left: 44px;
  padding-right: 44px;
}

/* Página izquierda (par) */
.page-left {
  border-left: 5px solid #cbd5e0;
}
.page-left::before {
  content: "";
  position: absolute;
  top: 20px;
  left: 0;
  width: 12px;
  height: calc(100% - 40px);
  background-image: radial-gradient(circle at center, #4b5563 4px, transparent 5px);
  background-size: 12px 40px;
  background-repeat: repeat-y;
  z-index: 10;
}

/* Página derecha (impar) */
.page-right {
  border-right: 5px solid #cbd5e0;
}
.page-right::before {
  content: "";
  position: absolute;
  top: 20px;
  right: 0;
  width: 12px;
  height: calc(100% - 40px);
  background-image: radial-gradient(circle at center, #4b5563 4px, transparent 5px);
  background-size: 12px 40px;
  background-repeat: repeat-y;
  z-index: 10;
}

/* Sombra de encuadernación */
.page-with-binding::after {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(to bottom, rgba(255,255,255,0.8), rgba(0,0,0,0.1));
  border-radius: 5px;
  box-shadow: inset 0 0 10px rgba(0,0,0,0.2);
  z-index: 0;
}
.font-montserrat {
  font-family: 'Montserrat', sans-serif;
  letter-spacing: 1px;
}
/* 📱 Ajustes para celulares y tablets elegantes */

@media (max-width: 767px) {
  .text-center h2 {
    font-size: 1.25rem;
    padding: 0 1rem;
    line-height: 1.4;
  }

  .book-shell {
    padding: 0 1rem;
    overflow-x: hidden;
  }

  #flipbook {
    width: 100%;
    height: auto;
    transform: scale(0.95);
    transform-origin: top center;
  }

  .page {
    width: 100%;
    height: auto;
    padding: 1rem;
    box-sizing: border-box;
  }

  .cover-page h1 {
    font-size: 1.5rem;
    line-height: 1.3;
    margin-bottom: 1rem;
  }

  .cover-page h2,
  .cover-page p {
    font-size: 1rem;
    max-width: 100%;
    margin-bottom: 0.5rem;
  }

  .text-lg.max-w-2xl {
    font-size: 1rem;
    max-width: 100%;
  }

  .page-scroll {
    max-width: 100%;
    height: auto;
    padding: 1rem;
    font-size: 0.95rem;
  }

  .page-scroll img {
    width: 5rem;
    height: 5rem;
    margin-bottom: 1rem;
  }

  #pageIndicator {
    font-size: 0.75rem;
    margin-right: 1rem;
    bottom: 1rem;
  }
}
</style>
<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/turn.js/4.1.0/turn.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&display=swap" rel="stylesheet">

<script>
$(function() {
  const $fb = $("#flipbook");
  const sound = document.getElementById("pageSound");

  // Inicializar Turn.js
  $fb.turn({
    width: 900,
    height: 520,
    display: "single",
    autoCenter: true,
    gradients: true,
    elevation: 80,
  });

  // Sonido y display
  $fb.on("turning", function(e, page) {
    sound.currentTime = 0;
    sound.play();
    const total = $fb.turn("pages");
    if (page === 0 || page === total) {
      if ($fb.turn("display") !== "single") $fb.turn("display", "single");
    } else {
      if ($fb.turn("display") !== "double") $fb.turn("display", "double");
    }
  });

  $fb.on("turned", function(e, page) {
    const total = $fb.turn("pages");

    if (page === 1) { $fb.turn("display", "single"); $fb.turn("center", true); }
    if (page === total) { $fb.turn("display", "single"); $fb.turn("center", true); }
    if (page === 1 || page === total) { $fb.turn("disable", true); setTimeout(() => $fb.turn("disable", false), 400); }

    $("#pageIndicator").text(`Página ${page - 1} de ${total - 2}`);

    // 🔑 Actualizar anillado dinámico
    updateBinding();
  });

  // Click navegación
  $fb.on("click", ".page", function(e){
    const offset = $fb.offset();
    const width = $fb.width();
    const pageX = e.pageX - offset.left;
    if (pageX < width / 2) $fb.turn("previous");
    else $fb.turn("next");
  });

  // Inicializar AOS
  AOS.init({ duration: 800, once: true });

  // 🔑 Función de anillado dinámico
  function updateBinding() { // Actualiza las clases de las páginas para el anillado
    const total = $fb.turn("pages"); // Total de páginas
    for (let i = 0; i <= total; i++) { // Recorrer todas las páginas
      const $page = $fb.turn("pageElement", i); // Obtener el elemento de la página
      $($page).removeClass("page-left page-right"); // Limpiar clases
      if (i === 0 || i === total) continue; // Saltar portada y contraportada
      if (i % 2 === 0) $($page).addClass("page-left");  // Si es par, es página izquierda
      else $($page).addClass("page-right"); // Si es impar, es página derecha
    }
  }

  // Llamar inicialmente
  updateBinding();
});
</script>

@endsection
