<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class PlantillaDocumento extends Model
{
    use HasFactory;

    protected $table = 'plantillas_documentos';

    protected $fillable = ['nombre', 'codtipodocumento'];
}
