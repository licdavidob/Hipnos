<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_Estacionamiento extends Model
{
    use HasFactory;

    protected $table = 'tipo_estacionamiento';

    protected $primaryKey = 'ID_Tipo_Estacionamiento';

    protected $fillable = [
        'Tipo_Estacionamiento',
        'Estatus',
    ];

    public function Estacionamiento()
    {
        return $this->hasMany(Estacionamiento::class, 'ID_Tipo_Estacionamiento', 'ID_Tipo_Estacionamiento');
    }
}
