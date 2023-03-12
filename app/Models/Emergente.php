<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emergente extends Model
{
    use HasFactory;

    protected $table = 'emergente';

    protected $primaryKey = 'ID_Emergente';

    protected $fillable = [
        'ID_Estacionamiento',
        'Estatus',
    ];

    public function Estacionamiento()
    {
        return $this->belongsTo(Estacionamiento::class, 'ID_Estacionamiento', 'ID_Estacionamiento');
    }
}
