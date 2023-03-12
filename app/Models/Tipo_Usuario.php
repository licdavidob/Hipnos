<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_Usuario extends Model
{
    use HasFactory;

    protected $table = 'tipo_usuario';

    protected $primaryKey = 'ID_Tipo_Usuario';

    protected $fillable = [
        'Tipo_Usuario',
        'Estatus'
    ];

    public function Usuario()
    {
        return $this->hasMany(Usuario::class, 'ID_Tipo_Usuario', 'ID_Tipo_Usuario');
    }


}
