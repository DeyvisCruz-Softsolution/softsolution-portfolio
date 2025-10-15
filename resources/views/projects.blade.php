@extends('layouts.app')

@section('title', 'Projects')

@section('content')
<section class="py--4">
    <h2 class="text-3xl font-bold mb-3 text-[var(--color-primary)] text-center">Proyectos</h2>

    {{-- Ahora 3 columnas en vez de 2 --}}
    <div class="grid grid-cols-3 gap-8">
        @foreach($projects as $project)
        <dl class="relative group project-card">
            {{-- Número decorativo --}}
            <span class="card-number">{{ $loop->iteration }}</span>

            {{-- Título (vertical) --}}
            <dt class="card-title-vertical">{{ $project->title }}</dt>

            {{-- Contenido principal --}}
            <dd class="card-body">
                {{-- Botones --}}
                <div class="card-buttons">
                    <button
                        type="button"
                        class="card-btn card-btn--info"
                        onclick="openInfoModal(event, {{ $project->id }})"
                        aria-haspopup="dialog"
                    >
                        Ver + Info.
                    </button>

                    @if($project->gallery)
                    <button
                        type="button"
                        class="card-btn card-btn--gallery"
                        onclick="openGalleryModal(event, {{ $project->id }})"
                        aria-haspopup="dialog"
                    >
                        Ver Galería
                    </button>
                    @endif
                </div>
            </dd>
        </dl>

        {{-- Modal de Información --}}
        <div id="infoModal-{{ $project->id }}"
             class="modal hidden"
             role="dialog"
             aria-hidden="true">
            <div class="modal-content">
                <button class="modal-close" onclick="closeModal(event)">✕</button>
                <h3 class="modal-title">{{ $project->title }}</h3>
                <div class="modal-body text-justify">
                    {!! $project->description !!}
                    @if($project->client_name)
                        <p><strong>Cliente:</strong> {{ $project->client_name }}</p>
                    @endif
                    @if($project->start_date)
    <p>
        <strong>Fechas:</strong>
        {{ \Carbon\Carbon::parse($project->start_date)->format('d/m/Y') }} -
        {{ $project->end_date ? \Carbon\Carbon::parse($project->end_date)->format('d/m/Y') : 'Actualidad' }}
    </p>
@endif

                    @if($project->link)
                        <p><a href="{{ $project->link }}" target="_blank" class="text-[var(--color-accent)] underline">Ver proyecto</a></p>
                    @endif
                </div>
            </div>
        </div>

        {{-- Modal de Galería --}}
        @if($project->gallery)
        <div id="galleryModal-{{ $project->id }}"
             class="modal hidden"
             role="dialog"
             aria-hidden="true">
            <div class="modal-content modal-gallery">
                <button class="modal-close" onclick="closeModal(event)">✕</button>
                <h3 class="modal-title">{{ $project->title }} - Galería</h3>
                <div class="modal-gallery-stage">
                    @foreach($project->gallery as $index => $image)
                     <img src="{{ asset('images/' . $image) }}"
                         alt="gallery {{ $project->title }}"
                        class="gallery-img @if($index === 0) active @endif">


                    @endforeach
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</section>

<style>
body {
    background: #eee;
    font-family: 'Inter', sans-serif;
    }

/* --- CARD PRINCIPAL --- */
.project-card {
    display: flex;
    align-items: stretch; /* para que todas las cards tengan la misma altura */
    position: relative; /* para posicionar elementos absolutos dentro */
    min-height: 280px; /* para que todas las cards tengan la misma altura */
    max-height: 280px; /* para que todas las cards tengan la misma altura */
    padding: 1.5rem;
    background: purple;
    border-radius: 14px;
    box-shadow: -4px 4px 8px rgba(0,0,0,0.1);
    overflow: hidden;
    width: 100%;
}

/* Número decorativo */
.card-number {
    font-size: 9rem; /* reducido para que quepa en 3 columnas */
    font-weight: 700;
    color: white;
    line-height: 1;
    margin-right: -5rem;
    transition: transform 0.6s ease, color 0.4s ease; /* suavizado */

}
.project-card:hover .card-number {
    transform: translateY(-8%);
    color: rgba(200, 230, 201); /* más claro al hacer hover */
}

/* Título en vertical */
.card-title-vertical {
    position: absolute;          /* lo anclamos dentro de la card */
    top: 50%;                    /* lo bajamos al centro */
    right: 5rem;                 /* separación del borde derecho */
    transform: translateY(-50%) rotate(180deg); /* centrado + giro */
    writing-mode: vertical-rl;   /* texto en vertical */
    font-size: 1.2rem;
    font-weight: bold;
    color: burlywood;          /* color claro */
    text-align: center;
    white-space: normal;         /* permitir saltos de línea */
    word-wrap: break-word;       /* permitir romper palabras largas */
    line-height: 1.1;
    max-height: 90%;             /* evitar que se salga */
}

/* Cuerpo de la card */
.card-body {
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 1rem;
    flex: 1;
}

/* ==========================
   FIX: botones fijos en la card
   ========================== */
/* Anclamos los botones de forma absoluta dentro de la tarjeta para que no se muevan
   aunque el título u otro contenido cambie su tamaño */
.card-buttons {
    position: absolute;                      /* los anclamos dentro del card (.project-card es relative) */
    left: calc(18rem + 1rem);                 /* separa los botones del número decorativo (5rem = .card-number font-size) */
    bottom: 6rem;                         /* siempre a 6rem del borde inferior de la card */
    display: flex;
    flex-direction: column;                  /* uno debajo del otro */
    gap: 0.6rem;
    width: 100px;                            /* ancho fijo para ambos botones */
    z-index: 60;                             /* por encima del contenido */
    pointer-events: auto;                    /* aseguramos que sean clicables */
}

/* Botones: mismo tamaño visual siempre */
.card-btn {
    width: 100%;                             /* ocupa el ancho fijo del contenedor (.card-buttons) */
    padding: 0.45rem 0.6rem;                 /* más compacto */
    border-radius: 6px;
    border: none;
    font-weight: 600;
    font-size: 0.8rem;
    cursor: pointer;
    transition: transform .14s ease, box-shadow .14s ease;
    box-shadow: 0 6px 14px rgba(0,0,0,0.06); /* sombra ligera */
    text-align: center;
}
.card-btn--info {
    background: #f7d9c4;
    color: #333;
}
.card-btn--gallery {
    background: #c4d9f7;
    color: #333;
}
.card-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 22px rgba(0,0,0,0.10);
}

/* Ajustes para pantallas pequeñas: reducimos offsets y ancho */
@media (max-width: 900px) {
    .card-buttons {
        left: calc(3.6rem + 0.8rem);  /* cuando el número es más pequeño en móvil */
        bottom: 0.9rem;
        width: 120px;
    }
    .card-btn { font-size: 0.78rem; padding: 0.4rem 0.5rem; }
}

/* --- MODAL GENERAL --- */
.modal {
    position: fixed;
    inset: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    background: rgba(0,0,0,0.6);
    z-index: 1000;
    padding: 1rem;
}
.modal.hidden { display: none; }

.modal-content {
    background: #fff;
    border-radius: 14px;
    max-width: 800px;
    width: 100%;
    max-height: 90vh;
    overflow-y: auto;
    padding: 2rem;
    position: relative;
}
.modal-close {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background: transparent;
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
}
.modal-title {
    font-size: 1.4rem;
    font-weight: bold;
    margin-bottom: 1rem;
}

/* --- GALERÍA --- */
.modal-gallery-stage {
    position: relative;
    width: 100%;
    height: 400px;
    overflow: hidden;
}
.modal-body ul {
  list-style-type: disc;
  padding-left: 1.5rem;
  margin-top: 0.5rem;
}

.modal-body li {
  margin-bottom: 0.25rem;
}

.gallery-img {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: contain;
    opacity: 0;
    transition: opacity 0.5s ease;
    background-color: #000; /* opcional: para que se vea mejor si hay espacio sobrante */
}
.gallery-img.active { opacity: 1; }
</style>

<script>
let slideshows = {};

function openInfoModal(event, id) {
    event.stopPropagation();
    closeAllModals();
    const el = document.getElementById('infoModal-' + id);
    if (!el) return;
    el.classList.remove('hidden');
    el.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
}

function openGalleryModal(event, id) {
    event.stopPropagation();
    closeAllModals();
    const modal = document.getElementById('galleryModal-' + id);
    if (!modal) return;
    modal.classList.remove('hidden');
    modal.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
    startGalleryModalSlideshow(id);
}

function closeModal(event) {
    event.stopPropagation();
    const modal = event.target.closest('.modal');
    if (!modal) return;
    modal.classList.add('hidden');
    modal.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
    stopGalleryModalSlideshow(modal.id.replace('galleryModal-', ''));
}

function closeAllModals() {
    document.querySelectorAll('.modal').forEach(m => {
        m.classList.add('hidden');
        m.setAttribute('aria-hidden', 'true');
    });
    document.body.style.overflow = '';
}

/* --- SLIDESHOW --- */
function startGalleryModalSlideshow(id) {
    const modal = document.getElementById('galleryModal-' + id);
    if (!modal) return;
    const images = modal.querySelectorAll('.gallery-img');
    if (images.length === 0) return;

    let index = 0;
    images.forEach((img,i)=> img.classList.toggle('active', i===0));

    slideshows[id] = setInterval(() => {
        images[index].classList.remove('active');
        index = (index + 1) % images.length;
        images[index].classList.add('active');
    }, 3000);
}

function stopGalleryModalSlideshow(id) {
    if (slideshows[id]) {
        clearInterval(slideshows[id]);
        delete slideshows[id];
    }
}
</script>
@endsection
