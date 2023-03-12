<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    protected $table = 'marca';

    protected $primaryKey = 'ID_Marca';

    protected $fillable = [
        'Marca',
        'Estatus',
    ];

    public function Modelo()
    {
        return $this->hasMany(Modelo::class, 'ID_Marca', 'ID_Marca');
    }
}
