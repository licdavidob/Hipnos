<?php

namespace App\Http\Controllers;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class GenerarQR extends Controller
{
    public function CrearbyID($idUser)
    {
        return QrCode::generate('Me gusta Vane');
    }
}
