<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IntegrantesGrupo extends Model
{
	protected $table = 'integrantes_grupo';
    protected $fillable = ['id_grupo','id_user','id_broker','id_nivel','fecha_inicio','fecha_fin'];

    public function grupos(){
    	return $this->belongsTo(Grupo::class , 'id_grupo');
}
