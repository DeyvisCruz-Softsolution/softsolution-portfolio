<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // título del proyecto
            $table->string('slug')->unique(); // slug amigable para URL
            $table->text('description')->nullable(); // descripción larga
            $table->string('client_name')->nullable(); // cliente
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->enum('status', ['pending', 'in_progress', 'completed'])->default('pending');
            $table->string('cover_image')->nullable(); // imagen principal
            $table->json('gallery')->nullable(); // múltiples imágenes
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
