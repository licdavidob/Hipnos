<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    use HasFactory;

    protected $table = 'permiso';

    protected $primaryKey = 'ID_Permiso';

    protected $fillable = [
        'Inicio_Ingreso',
        'Fin_Ingreso',
        'Estatus',
    ];

    public function Usuario()
    {
        return $this->belongsTo(Usuario::class, 'ID_Permiso', 'ID_Permiso');
    }
}
