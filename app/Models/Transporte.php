<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transporte extends Model
{
    protected $table = 'transportes';

    protected $fillable = ['nombre'];

    public function gps()
    {
        return $this->hasMany(Gps::class);
    }
}
