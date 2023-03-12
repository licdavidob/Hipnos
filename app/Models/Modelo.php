<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    use HasFactory;

    protected $table = 'modelo';

    protected $primaryKey = 'ID_Modelo';

    protected $fillable = [
        'Modelo',
        'ID_Marca',
        'Estatus',
    ];

    public function Marca()
    {
        return $this->belongsTo(Marca::class, 'ID_Marca', 'ID_Marca');
    }

    public function Vehiculo()
    {
        return $this->hasMany(Vehiculo::class, 'ID_Modelo', 'ID_Modelo');
    }
}
