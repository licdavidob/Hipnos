<?php

namespace App\Http\Controllers;

use App\Models\CodigoQR;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class GenerarQR extends Controller
{
    public int $ID_CodigoQR;
    public int $ID_Usuario;
    public string $Nombre;
    public string $Ruta;
    public string $Tipo;
    public ?string $Imagen;
    public int $Estatus;

    public function __construct($Tipo = 'png')
    {
        $this->Tipo = $Tipo;
    }

    public function store(UsuarioController $Usuario)
    {
        $this->ID_Usuario = $Usuario->ID_Usuario;
        $this->Imagen = $this->generateByUsuarioId($this->ID_Usuario);
        $this->Nombre = $this->nameQR($Usuario);
        $this->Ruta = 'qrcodes/' . $this->Nombre . $this->Tipo;
        //Se almacena la imagen
        Storage::disk('public')->put($this->Ruta, $this->Imagen);
        //Se obtiene la URL donde se almaceno la imagen
        $this->Ruta = Storage::url($this->Ruta);

        CodigoQR::create([
            'ID_Usuario' => $this->ID_Usuario,
            'Nombre' => $this->Nombre,
            'Ruta' => $this->Ruta,
            'Tipo' => $this->Tipo,
        ]);

        return $this;
    }

    public function generateByUsuarioId($ID_Usuario)
    {
        return QrCode::format($this->Tipo)->size(1000)->generate($ID_Usuario);
    }

    public function nameQR(UsuarioController $Usuario)
    {
        return "$Usuario->Nombre" . "_" . "$Usuario->Ap_Paterno" . "_" . "$Usuario->Ap_Materno" . "_" . "$Usuario->ID_Usuario" . ".";
    }

    public function existsQR()
    {
        if (Storage::disk('public')->exists('qrcodes/' . $this->Nombre . $this->Tipo)) {
            $this->Imagen = Storage::disk('public')->get('qrcodes/' . $this->Nombre . $this->Tipo);
        }

        return $this;
    }

    public function modelToObject($ModeloQR)
    {
        $this->ID_CodigoQR = $ModeloQR->ID_CodigoQR;
        $this->Nombre = $ModeloQR->Nombre;
        $this->Ruta = $ModeloQR->Ruta;
        $this->Tipo = $ModeloQR->Tipo;
        $this->Estatus = $ModeloQR->Estatus;

        return $this;
    }
}
