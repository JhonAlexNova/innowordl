<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado_Etapa extends Model
{
    protected $table = 'estado_etapa';

    protected $fillable = ['nombre'];
}
