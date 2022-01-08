<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    use HasFactory;
    protected $fillable = [
        'tarjeta_amarilla',
        'tarjeta_roja',
        'gol',
        'partido',
    ];

    public function incidencias()
    {
        return $this->belongsToMany(Entrenador::class);
    }
}
