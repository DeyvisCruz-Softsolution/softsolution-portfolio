@extends('layouts.app')

@section('title', 'Blog')

@section('content')
<div class="container mx-auto px-4 py-12">
    <h1 class="text-4xl font-bold mb-8 text-center text-[var(--color-primary)]">Blog</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach($blogs as $post)
            <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-2xl transition">
                @if($post->cover_image)
                    <img src="{{ asset('storage/' . $post->cover_image) }}"
                         alt="{{ $post->title }}"
                         class="rounded-lg mb-4 w-full h-48 object-cover">
                @endif
                <h2 class="text-2xl font-semibold mb-2">{{ $post->title }}</h2>
                <p class="text-gray-600 mb-4">{{ Str::limit($post->content, 100) }}</p>
                <a href="{{ route('blog.show', $post->id) }}"
                   class="text-[var(--color-accent)] hover:underline">Leer más</a>
            </div>
        @endforeach
    </div>
</div>
@endsection
