@extends('layouts.app')

@section('title', 'Contacto')

@section('content')
<div class="container mx-auto px-4 py-12">
    <h1 class="text-4xl font-bold mb-8 text-center text-[var(--color-primary)]">Contáctame</h1>

    <div class="bg-white rounded-2xl shadow-lg p-8 max-w-lg mx-auto">
        <form action="{{ route('messages.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="block font-semibold mb-1">Nombre</label>
                <input type="text" name="name" class="w-full border rounded-lg p-3" required>
            </div>
            <div>
                <label class="block font-semibold mb-1">Correo electrónico</label>
                <input type="email" name="email" class="w-full border rounded-lg p-3" required>
            </div>
            <div>
                <label class="block font-semibold mb-1">Mensaje</label>
                <textarea name="message" rows="5" class="w-full border rounded-lg p-3" required></textarea>
            </div>
            <button type="submit" class="w-full bg-[var(--color-primary)] text-white py-3 rounded-lg font-bold hover:bg-[var(--color-accent)] transition">
                Enviar mensaje
            </button>
        </form>
    </div>
</div>
@endsection
