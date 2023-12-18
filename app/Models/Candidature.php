<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidature extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'formation_id',
        'etat'
    ];

    public function user()
    {
        return $this->belongsToMany(User::class, 'user_id');
    }

    public function formation()
    {
        return $this->belongsToMany(Formation::class, 'formation_id');
    }
}
