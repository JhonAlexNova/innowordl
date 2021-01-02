<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';

    protected $fillable = ['id_categoria','titulo','img_titulo','ingredientes','imagen','precio'];
    public $timestamps = false;
}
