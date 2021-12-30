<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrenador extends Model
{
    use HasFactory;
    protected $fillable = [
        'dni',
        'nombre',
        'apellidos',
        'puesto',
        'equipo',
    ];

    public function entrenadores()
    {
        return $this->belongsToMany(Entrenador::class);
    }
}
