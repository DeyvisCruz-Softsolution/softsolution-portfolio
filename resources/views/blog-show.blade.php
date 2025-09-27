@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="container mx-auto px-4 py-12">
    <div class="bg-white rounded-2xl shadow-lg p-8 max-w-3xl mx-auto">
        @if($post->cover_image)
            <img src="{{ asset('storage/' . $post->cover_image) }}"
                 alt="{{ $post->title }}"
                 class="rounded-lg mb-6 w-full h-72 object-cover">
        @endif

        <h1 class="text-4xl font-bold text-[var(--color-primary)] mb-4">{{ $post->title }}</h1>
        <p class="text-gray-500 mb-6">Publicado el {{ $post->created_at->format('d M Y') }}</p>

        <div class="prose max-w-none text-gray-700">
            {!! nl2br(e($post->content)) !!}
        </div>

        <div class="mt-8">
            <a href="{{ route('blog') }}"
               class="text-[var(--color-accent)] font-semibold hover:underline">← Volver al blog</a>
        </div>
    </div>
</div>
@endsection
