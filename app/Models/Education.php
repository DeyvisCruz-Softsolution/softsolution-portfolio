<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    // 👇 Esto fuerza el nombre correcto de la tabla
    protected $table = 'educations';

    protected $fillable = [
        'institution',
        'degree',
        'start_date',
        'end_date',
        'description',
        'category',
    ];
}
