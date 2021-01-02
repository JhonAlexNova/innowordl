<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Variaciones extends Model
{
    protected $table = 'variaciones';

    protected $fillable = ['id_producto','titulo','img_titulo','descripcion','precio'];
    public $timestamps = false;
}
