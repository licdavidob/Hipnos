<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuario';

    protected $primaryKey = 'ID_Usuario';

    protected $fillable = [
        'Nombre',
        'Ap_Paterno',
        'Ap_Materno',
        'ID_Tipo_Usuario',
        'ID_Permiso',
        'Telefono',
        'Email',
        'Estatus'
    ];

    public function Permiso()
    {
        return $this->hasOne(Usuario::class, 'ID_Permiso', 'ID_Permiso');
    }

    public function Tipo_Usuario()
    {
        return $this->belongsTo(Tipo_Usuario::class, 'ID_Tipo_Usuario', 'ID_Tipo_Usuario');
    }

    public function Vehiculo()
    {
        return $this->hasMany(Vehiculo::class, 'ID_Vehiculo', 'ID_Vehiculo');
    }

    public function CodigoQR()
    {
        return $this->hasOne(CodigoQR::class, 'ID_Usuario', 'ID_Usuario');
    }

    public function Entrada_Salida()
    {
        return $this->hasMany(Entrada_Salida::class, 'ID_Usuario', 'ID_Usuario');
    }
}
