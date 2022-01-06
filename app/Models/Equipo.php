<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;
    protected $fillable = [
        'cod_equipo',
        'nombre',
        'ciudad',
        'presupuesto',
    ];

    public function equipos()
    {
        return $this->belongsToMany(Equipo::class);
    }
}
