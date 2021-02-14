<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    protected $table = 'niveles';

    protected $fillable = ['nombre'];

    public function grupos()
    {
        return $this->hasMany(Grupo::class, 'id_nivel');
    }
}
