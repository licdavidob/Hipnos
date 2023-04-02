<?php

namespace App\Http\Controllers;

use PhpParser\Node\Stmt\Return_;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class GenerarQR extends Controller
{
    public $ImagenSVG;
    public $Nombre;

    public function CrearbyID($ID_Usuario)
    {
        $this->ImagenSVG = QrCode::generate($ID_Usuario);
        return $this;
    }

    public function NombreQR(UsuarioController $Usuario)
    {
        $this->Nombre = "$Usuario->Nombre" . "_" . "$Usuario->Ap_Paterno" . "_" . "$Usuario->Ap_Materno" . "_" . "$Usuario->ID_Usuario";
        return $this;
    }
}
