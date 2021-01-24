<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $table = 'factura';

    protected $fillable = [
            'id_user',
            'id_broker',
            'numero_factura',
            'estado',
            'fecha_acuerdo',
            'hora_registro',
            'total',
            'descuento',
            'nombre_acudiente',
            'documento_acudiente',
            'correo_acudiente',
            'telefono_acudiente'
    ];
}
