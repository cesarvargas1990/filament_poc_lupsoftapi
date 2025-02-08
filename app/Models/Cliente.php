<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'numero_documento',
        'email',
        'cobrador',
        'fecha_expedicion',
        'fecha_nacimiento',
        'tipo_documento',
        'ciudad',
        'telefono',
        'celular',
        'dir_casa',
        'dir_trabajo',
        'referencia_1',
        'referencia_2',
        'firma_cliente',
        'cedula',
        'foto',
    ];
}
