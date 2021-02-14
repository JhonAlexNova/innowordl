<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $table = 'grupos';
    protected $fillable = ['id_nivel','nombre','fecha_inicio','fecha_fin'];

    public function niveles(){
    	return $this->hasMany(Nivel::class, 'id','id_nivel');
    }
}
