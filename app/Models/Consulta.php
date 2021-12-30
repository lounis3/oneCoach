<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;
    protected $fillable = [
        'fecha',
        'jugador',
        'medico',
    ];

    public function consultas()
    {
        return $this->belongsToMany(Consulta::class);
    }
}
