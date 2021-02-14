<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoModulo extends Model
{
    protected $table = 'estados_modulos';

    protected $fillable = ['id_estado','id_modulo'];

    public function estados(){
    	return $this->belongsTo(Estado::class, 'id_estado');
    }
}
