<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;

    protected $table = 'vehiculo';

    protected $primaryKey = 'ID_Vehiculo';

    protected $fillable = [
        'ID_Usuario',
        'ID_Modelo',
        'Placa',
        'Color',
        'NIV',
        'Estatus',
    ];

    public function Usuario()
    {
        return $this->belongsTo(Usuario::class, 'ID_Usuario', 'ID_Usuario');
    }

    public function Modelo()
    {
        return $this->belongsTo(Modelo::class, 'ID_Modelo', 'ID_Modelo');
    }
}
