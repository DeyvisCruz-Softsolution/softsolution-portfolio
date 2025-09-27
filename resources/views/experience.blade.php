@extends('layouts.app')

@section('title', 'Experiencia')

@section('content')
<div class="container mx-auto px-4 py--3">
    <h1 class="text-5xl font-extrabold mb-12 text-center text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 drop-shadow-lg">
        Experiencia
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @foreach($experiences as $experience)
            <div class="bg-white rounded-2xl shadow-lg p-1 relative experience-card cursor-pointer"
                data-logo="{{ $experience->logo ? asset('storage/' . $experience->logo) : '' }}"
                data-company="{{ $experience->company }}"
                data-position="{{ $experience->position }}"
                data-dates="{{ $experience->start_date->format('d/m/Y') }} - {{ $experience->end_date?->format('d/m/Y') ?? 'Actualidad' }}"
                data-description='{!! addslashes($experience->description) !!}'>

                <div class="flex items-center gap-4">
                    @if($experience->logo)
                        <img src="{{ asset('storage/' . $experience->logo) }}" alt="Logo" class="w-16 h-16 object-contain rounded-lg">
                    @endif
                    <div>
                        <h2 class="text-xl font-semibold">{{ $experience->company }}</h2>
                        <p class="text-gray-500 text-sm">{{ $experience->position }}</p>
                        <p class="text-gray-400 text-xs">{{ $experience->start_date->format('d/m/Y') }} - {{ $experience->end_date?->format('d/m/Y') ?? 'Actualidad' }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Popup central -->
<div id="experience-popup" class="fixed top-1/2 left-1/2 w-4/5 max-w-6xl max-h-[85vh] overflow-auto bg-white text-gray-800 rounded-3xl shadow-2xl p-8 z-50 opacity-0 scale-90 pointer-events-none transition-all duration-300 -translate-x-1/2 -translate-y-1/2">
    <div class="flex flex-col md:flex-row gap-6">
        <img id="popup-logo" src="" alt="Logo" class="w-32 h-32 object-contain rounded-lg hidden flex-shrink-0">
        <div class="flex-1 overflow-auto">
            <h3 id="popup-company" class="text-2xl font-bold mb-2"></h3>
            <p id="popup-position" class="text-base italic mb-4"></p>
            <p id="popup-dates" class="text-sm text-gray-500 mb-4"></p>
            <div id="popup-description" class="prose max-w-full leading-relaxed text-sm break-words"></div>
        </div>
    </div>
</div>

<script>
const popup = document.getElementById('experience-popup');
const logo = document.getElementById('popup-logo');
const company = document.getElementById('popup-company');
const position = document.getElementById('popup-position');
const dates = document.getElementById('popup-dates');
const description = document.getElementById('popup-description');

let hoverCard = null;   // Card actual bajo el cursor
let popupTimeout = null;

document.querySelectorAll('.experience-card').forEach(card => {
    card.addEventListener('mouseenter', () => {
        hoverCard = card;

        popupTimeout = setTimeout(() => {
            const dataLogo = card.dataset.logo;
            if(dataLogo) {
                logo.src = dataLogo;
                logo.classList.remove('hidden');
            } else {
                logo.classList.add('hidden');
            }

            company.textContent = card.dataset.company;
            position.textContent = card.dataset.position;
            dates.textContent = card.dataset.dates;
            description.innerHTML = card.dataset.description;

            popup.classList.remove('opacity-0', 'scale-90', 'pointer-events-none');
            popup.classList.add('opacity-100', 'scale-100', 'pointer-events-auto');
        }, 50); // pequeño retraso para evitar parpadeo
    });

    card.addEventListener('mouseleave', () => {
        hoverCard = null;
        clearTimeout(popupTimeout);
        setTimeout(() => {
            if(!hoverCard && !popup.matches(':hover')) {
                popup.classList.add('opacity-0', 'scale-90', 'pointer-events-none');
                popup.classList.remove('opacity-100', 'scale-100', 'pointer-events-auto');
            }
        }, 50);
    });
});

popup.addEventListener('mouseleave', () => {
    if(!hoverCard) {
        popup.classList.add('opacity-0', 'scale-90', 'pointer-events-none');
        popup.classList.remove('opacity-100', 'scale-100', 'pointer-events-auto');
    }
});
</script>



<style>
/* Estilos para listas y viñetas */
.prose ul {
    list-style-type: disc;
    margin-left: 1rem;
}
.prose ol {
    list-style-type: decimal;
    margin-left: 1rem;
}

/* Scrollbar elegante */
#experience-popup::-webkit-scrollbar {
    width: 8px;
}
#experience-popup::-webkit-scrollbar-thumb {
    background: linear-gradient(to bottom, #6366f1, #a855f7, #ec4899);
    border-radius: 4px;
}
#experience-popup::-webkit-scrollbar-track {
    background: transparent;
}

/* Hacer que el popup ocupe todo el ancho y alto disponible de su contenedor */
#experience-popup .flex-1 {
    max-height: 75vh;
}
</style>
@endsection
