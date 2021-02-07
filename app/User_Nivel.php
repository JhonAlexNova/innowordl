<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Nivel extends Model
{
    protected $table = 'user_nivel';

    protected $fillable = ['id_user','id_nivel'];
}
