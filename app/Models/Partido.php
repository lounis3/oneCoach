<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    use HasFactory;
    protected $fillable = [
        'fecha',
        'jornada',
        'adversario',
        'resultado',
        'estadio',
        'equipo',
    ];

    public function partidos()
    {
        return $this->belongsToMany(Partido::class);
    }
}
