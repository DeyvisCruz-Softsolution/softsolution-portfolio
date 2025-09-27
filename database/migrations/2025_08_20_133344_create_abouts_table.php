<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Título del perfil
            $table->text('description')->nullable(); // Descripción / biografía
            $table->string('image')->nullable(); // Foto o avatar
            $table->string('cv_file')->nullable(); // Archivo CV
            $table->json('social_links')->nullable(); // Redes sociales en formato JSON
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
