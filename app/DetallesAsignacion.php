<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetallesAsignacion extends Model
{
    protected $table = 'detalles_asignacion';

    protected $fillable = ['id_user','id_broker','id_estado','fecha','hora','hora_registro','observacion'];
}
