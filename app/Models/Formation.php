<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle',
        'description',
        'debut_candidature',
        'fin_candidature',
        'duree',
        'image'
    ];

}
