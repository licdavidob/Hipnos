<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodigoQR extends Model
{
    use HasFactory;

    protected $table = 'codigoqr';

    protected $primaryKey = 'ID_CodigoQR';

    protected $fillable = [
        'ID_Usuario',
        'Nombre',
        'Ruta',
        'Tipo',
        'Estatus'
    ];

    public function Usuario()
    {
        return $this->belongsTo(Usuario::class, 'ID_Usuario', 'ID_Usuario');
    }
}
