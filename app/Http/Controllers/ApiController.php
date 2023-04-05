<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ParkingController;

class ApiController extends Controller
{
    private array $Message = array(
        'message' => '',
        'access' => false,
    );

    public function UsuarioAccess(Request $request)
    {
        if (!$request->IdUsuario) {
            $this->Message['message'] = 'Id de usuario incorrecto';
            return $this->Message;
        }

        if (!$request->HashEstacionamiento) {
            $this->Message['message'] = 'Hash incorrecto';
            return $this->Message;
        }

        $Parking = new ParkingController();
        if (!$Parking->Access($request->IdUsuario, $request->HashEstacionamiento)) {
            $this->Message['message'] = 'No puede acceder el usuario';
            return $this->Message;
        }

        $Parking->registrarIngresoEgreso($request->IdUsuario);

        $this->Message['message'] = 'El usuario puede acceder';
        $this->Message['access'] = true;
        return $this->Message;
    }
}
