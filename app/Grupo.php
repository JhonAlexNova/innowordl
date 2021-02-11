<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $table = "grupos";

    protected $fillable = ["id_nivel","nombre","fecha_inicio", "fecha_fin"];

    public function usuarios()
    {
        return $this->belongsToMany(User::class,'integrantes_grupos','id_grupo', 'id_user');
    }
    public function nivel()
    {
        return $this->belongsTo(Nivel::class,'id_nivel');
    }
}
