<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estadistica extends Model
{
    use HasFactory;
    protected $fillable = [
        'partidos_jug',
        'goles',
        'asistencias',
        'ciclo_tarjetas',
        'jugadors',
    ];

    public function estadisticas()
    {
        return $this->belongsToMany(Estadistica::class);
    }
}
