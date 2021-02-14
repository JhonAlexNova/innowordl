<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetallesAsignacion extends Model
{
    protected $table = 'detalles_asignacion';

    protected $fillable = ['id_user','id_broker','id_estado','estado','fecha','hora','hora_registro','observacion'];


    public function users(){
    	return $this->belongsTo(User::class, 'id_user','id');
    }
}
