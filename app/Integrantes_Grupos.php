<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Integrantes_Grupos extends Model
{
    protected $table = 'integrantes_grupos';

    protected $fillable = ['id_estado','id_grupo','id_user','id_broker','id_nivel','fecha_inicio','fecha_fin','estado'];
}
