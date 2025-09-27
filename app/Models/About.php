<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'cv_file',
        'social_links',
    ];

    protected $casts = [
        'social_links' => 'array',
    ];
}
