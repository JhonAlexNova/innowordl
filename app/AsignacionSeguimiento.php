<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AsignacionSeguimiento extends Model
{
    protected $table = 'asignacion_seguimiento';

    protected $fillable = ['id_user','id_broker'];
}
