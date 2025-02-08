<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $table = 'empresas';

    protected $fillable = [
        'nombre',
        'nit',
        'capital_inicial',
        'pagina_web',
        'ciudad',
        'email',
        'telefono',
        'direccion',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
