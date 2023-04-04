<?php

namespace App\Http\Controllers;

use App\Models\Estacionamiento;
use Illuminate\Http\Request;

class EstacionamientoController extends Controller
{
    public int $ID_Estacionamiento;
    public string $Hash;
    public string $TipoEstacionamiento;
    public int $Estatus;

    public function estacionamientoByHash($hash_estacionamiento, $error404 = true)
    {
        $Busqueda = Estacionamiento::where('Hash', $hash_estacionamiento)->first();

        if ($Busqueda) {
            return $Busqueda;
        }

        if ($error404) {
            return abort(404);
        }

        return false;
    }

    public function modelToObject($ModelEstacionamiento)
    {
        $this->ID_Estacionamiento = $ModelEstacionamiento->ID_Estacionamiento;
        $this->Hash = $ModelEstacionamiento->Hash;
        $this->TipoEstacionamiento = $ModelEstacionamiento->Tipo_Estacionamiento->Tipo_Estacionamiento;
        $this->Estatus = $ModelEstacionamiento->Estatus;

        return $this;
    }
}
