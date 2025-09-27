<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'client_name',
        'start_date',
        'end_date',
        'status',
        'cover_image',
        'gallery',
    ];

    protected $casts = [
        'gallery' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    // Generar slug automáticamente al crear
    protected static function booted()
    {
        static::creating(function ($project) {
            $project->slug = Str::slug($project->title);
        });
    }
}
