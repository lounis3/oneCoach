<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jugador extends Model
{
    use HasFactory;
    protected $fillable = [
        'cod_ficha',
        'nombre',
        'apellidos',
        'edad',
        'dorsal',
        'posicion',
        'pie_dominante',
        'altura',
        'peso',
        'est_contrato',
        'salario',
        'equipo',
    ];

    public function jugadors()
    {
        return $this->belongsToMany(Jugador::class);
    }
}
