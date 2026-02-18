<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gps extends Model
{
    protected $table = 'gps';

    protected $fillable = [
        'transporte_id',
        'tipo_vehiculo',
        'placa',
        'plataforma',
        'destino',
        'usuario',
        'contrasena',
        'estado'
    ];


    public function transporte()
    {
        return $this->belongsTo(Transporte::class);
    }
}
