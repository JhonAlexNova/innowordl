<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetallesFactura extends Model
{
    protected $table = 'detalles_factura';

    protected $fillable =[
            'id_factura',
            'cantidad',
            'descripcion',
            'precio',
            'descuento',
            'hora'
    ];

       		
}
