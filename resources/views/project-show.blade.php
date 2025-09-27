@extends('layouts.app')

@section('title', $project->title)

@section('content')
<div class="container mx-auto px-4 py-12">
    <div class="bg-white rounded-2xl shadow-lg p-8 max-w-4xl mx-auto">
        @if($project->image)
            <img src="{{ asset('storage/' . $project->image) }}"
                 alt="{{ $project->title }}"
                 class="rounded-lg mb-6 w-full h-80 object-cover">
        @endif

        <h1 class="text-4xl font-bold text-[var(--color-primary)] mb-4">{{ $project->title }}</h1>
        <p class="text-gray-500 mb-6">
            {{ $project->start_date }} - {{ $project->end_date ?? 'Actualidad' }}
        </p>

        <div class="prose max-w-none text-gray-700">
            {!! nl2br(e($project->description)) !!}
        </div>

        @if($project->link)
            <div class="mt-6">
                <a href="{{ $project->link }}" target="_blank"
                   class="inline-block bg-[var(--color-primary)] text-white py-3 px-6 rounded-lg font-bold hover:bg-[var(--color-accent)] transition">
                    Ver proyecto
                </a>
            </div>
        @endif

        <div class="mt-8">
            <a href="{{ route('projects') }}"
               class="text-[var(--color-accent)] font-semibold hover:underline">← Volver a proyectos</a>
        </div>
    </div>
</div>
@endsection
