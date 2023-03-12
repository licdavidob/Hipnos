<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrada_Salida extends Model
{
    use HasFactory;

    protected $table = 'entrada_salida';

    protected $primaryKey = 'ID_Entrada_Salida';

    protected $fillable = [
        'ID_Usuario',
        'Fecha_Ingreso',
        'Fecha_Egreso',
        'Estatus'
    ];

    public function Usuario()
    {
        return $this->belongsTo(Usuario::class, 'ID_Usuario', 'ID_Usuario');
    }
}
