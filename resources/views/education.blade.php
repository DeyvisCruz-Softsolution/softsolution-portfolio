@extends('layouts.app')

@section('title', 'Educación')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 py-3">
    <div class="container mx-auto px-4">
        <!-- Header principal con animación -->
        <div class="text-center mb-5 animate-fade-in">
            <h1 class="text-5xl md:text-6xl font-bold bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-600 bg-clip-text text-transparent mb-4">
                Mi Educación
            </h1>
            <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-purple-500 mx-auto rounded-full"></div>
            <p class="text-gray-600 mt-4 text-lg">Formación académica y desarrollo profesional</p>
        </div>

        <!-- Educación Formal -->
        <div class="mb-16">
            <div class="flex items-center mb-8">
                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl flex items-center justify-center mr-4 shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                    </svg>
                </div>
                <h2 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                    Educación Formal
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($educations->where('category', 'education') as $index => $education)
                    <div class="education-card group relative bg-white/80 backdrop-blur-sm rounded-3xl p-6 shadow-xl border border-white/20 hover:shadow-2xl transition-all duration-700 transform hover:-translate-y-3 animate-slide-up" style="animation-delay: {{ $index * 0.1 }}s">

                        <!-- Efecto holográfico -->
                        <div class="absolute inset-0 rounded-3xl bg-gradient-to-r from-blue-400/20 via-purple-400/20 to-pink-400/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                        <!-- Contenido -->
                        <div class="relative z-10">
                            <!-- Badge de categoría -->
                            <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gradient-to-r from-blue-100 to-purple-100 text-blue-800 border border-blue-200 mb-4">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Educación Formal
                            </div>

                            <!-- Título -->
                            <h3 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-blue-600 transition-colors duration-300">
                                {{ $education->degree }}
                            </h3>

                            <!-- Institución y fechas -->
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4">
                                <p class="text-sm font-semibold text-blue-600 mb-2 sm:mb-0">
                                    {{ $education->institution }}
                                </p>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gradient-to-r from-green-100 to-blue-100 text-green-800 border border-green-200">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $education->start_date }} - {{ $education->end_date ?? 'Actualidad' }}
                                </span>
                            </div>

                            <!-- Descripción -->
                            <div class="text-gray-700 text-sm leading-relaxed text-justify prose prose-sm max-w-none">
                             {!! $education->description !!}
                            </div>

                            <!-- Indicador de progreso si es actual -->
                            @if(!$education->end_date)
                            <div class="mt-4 flex items-center">
                                <div class="flex-1 bg-gray-200 rounded-full h-2">
                                    <div class="bg-gradient-to-r from-blue-500 to-purple-600 h-2 rounded-full animate-pulse" style="width: 85%"></div>
                                </div>
                                <span class="ml-3 text-xs font-medium text-blue-600">En progreso</span>
                            </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Cursos Avanzados -->
        <div>
            <div class="flex items-center mb-8">
                <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-600 rounded-xl flex items-center justify-center mr-4 shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                    </svg>
                </div>
                <h2 class="text-3xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                    Cursos Avanzados
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($educations->where('category', 'course') as $index => $education)
                    <div class="course-card group relative bg-white/80 backdrop-blur-sm rounded-3xl p-6 shadow-xl border border-white/20 hover:shadow-2xl transition-all duration-700 transform hover:-translate-y-3 animate-slide-up" style="animation-delay: {{ $index * 0.1 }}s">

                        <!-- Efecto holográfico -->
                        <div class="absolute inset-0 rounded-3xl bg-gradient-to-r from-purple-400/20 via-pink-400/20 to-orange-400/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                        <!-- Contenido -->
                        <div class="relative z-10">
                            <!-- Badge de categoría -->
                            <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gradient-to-r from-purple-100 to-pink-100 text-purple-800 border border-purple-200 mb-4">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                Curso Avanzado
                            </div>

                            <!-- Título -->
                            <h3 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-purple-600 transition-colors duration-300">
                                {{ $education->degree }}
                            </h3>

                            <!-- Institución y fechas -->
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4">
                                <p class="text-sm font-semibold text-purple-600 mb-2 sm:mb-0">
                                    {{ $education->institution }}
                                </p>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gradient-to-r from-orange-100 to-pink-100 text-orange-800 border border-orange-200">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $education->start_date }} - {{ $education->end_date ?? 'Actualidad' }}
                                </span>
                            </div>

                            <!-- Descripción en Cursos Avanzados -->
                            <div class="text-gray-700 text-sm leading-relaxed text-justify prose prose-sm max-w-none">
                              {!! $education->description !!}
                                </div>

                            <!-- Indicador de progreso si es actual -->
                            @if(!$education->end_date)
                            <div class="mt-4 flex items-center">
                                <div class="flex-1 bg-gray-200 rounded-full h-2">
                                    <div class="bg-gradient-to-r from-purple-500 to-pink-600 h-2 rounded-full animate-pulse" style="width: 75%"></div>
                                </div>
                                <span class="ml-3 text-xs font-medium text-purple-600">En progreso</span>
                            </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Animaciones personalizadas */
@keyframes fade-in {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes slide-up {
    from { opacity: 0; transform: translateY(50px); }
    to { opacity: 1; transform: translateY(0); }
}

.animate-fade-in {
    animation: fade-in 1s ease-out;
}

.animate-slide-up {
    animation: slide-up 0.8s ease-out forwards;
    opacity: 0;
}

/* Efectos holográficos para educación formal */
.education-card::before {
    content: '';
    position: absolute;
    inset: -2px;
    border-radius: 24px;
    padding: 2px;
    background: linear-gradient(45deg, #3b82f6, #8b5cf6, #ec4899, #06b6d4);
    background-size: 300% 300%;
    opacity: 0;
    transition: opacity 0.5s;
    animation: gradient-shift 3s ease infinite;
    z-index: -1;
}

.education-card:hover::before {
    opacity: 0.7;
}

/* Efectos holográficos para cursos avanzados */
.course-card::before {
    content: '';
    position: absolute;
    inset: -2px;
    border-radius: 24px;
    padding: 2px;
    background: linear-gradient(45deg, #8b5cf6, #ec4899, #f59e0b, #ef4444);
    background-size: 300% 300%;
    opacity: 0;
    transition: opacity 0.5s;
    animation: gradient-shift 3s ease infinite;
    z-index: -1;
}

.course-card:hover::before {
    opacity: 0.7;
}

@keyframes gradient-shift {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}

/* Efectos de hover mejorados */
.education-card, .course-card {
    transform-style: preserve-3d;
    transition: all 0.7s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.education-card:hover, .course-card:hover {
    transform: translateY(-12px) rotateX(5deg) rotateY(5deg) scale(1.02);
    box-shadow:
        0 25px 50px -12px rgba(0, 0, 0, 0.25),
        0 0 0 1px rgba(255, 255, 255, 0.05),
        inset 0 1px 0 rgba(255, 255, 255, 0.1);
}

/* Responsive improvements */
@media (max-width: 768px) {
    .education-card:hover, .course-card:hover {
        transform: translateY(-8px) scale(1.01);
    }
}

/* Mejoras tipográficas */
.text-justify p {
    text-align: justify;
    margin-bottom: 0.5rem;
    line-height: 1.5;
}

.text-justify ul, .text-justify ol {
    text-align: left;
    margin: 0.5rem 0;
    padding-left: 1.25rem;
}

.text-justify li {
    margin-bottom: 0.25rem;
    line-height: 1.4;
}

/* Efectos adicionales */
.education-card::after, .course-card::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    border-radius: 24px;
    background: radial-gradient(circle at 50% 50%, rgba(255,255,255,0.1) 0%, transparent 70%);
    opacity: 0;
    transition: opacity 0.3s;
    pointer-events: none;
}

.education-card:hover::after, .course-card:hover::after {
    opacity: 1;
}

/* Efectos de brillo en títulos */
.education-card:hover h3 {
    text-shadow: 0 0 20px rgba(59, 130, 246, 0.3);
}

.course-card:hover h3 {
    text-shadow: 0 0 20px rgba(139, 92, 246, 0.3);
}
</style>
@endpush
