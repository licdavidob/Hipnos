<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estacionamiento extends Model
{
    use HasFactory;

    protected $table = 'estacionamiento';

    protected $primaryKey = 'ID_Estacionamiento';

    protected $fillable = [
        'Hash',
        'ID_Tipo_Estacionamiento',
        'Estatus',
    ];

    public function Tipo_Estacionamiento()
    {
        return $this->belongsTo(Tipo_Estacionamiento::class, 'ID_Tipo_Estacionamiento', 'ID_Tipo_Estacionamiento');
    }

    public function Emergente()
    {
        return $this->hasMany(Emergente::class, 'ID_Estacionamiento', 'ID_Estacionamiento');
    }
}
