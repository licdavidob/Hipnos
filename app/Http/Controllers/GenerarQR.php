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
    public string $Ruta_Local;
    public string $Ruta_Publica;
    public string $Tipo;
    public ?string $Imagen;
    public int $Estatus;

    public function __construct($Tipo = 'png')
    {
        $this->Tipo = $Tipo;
    }

    public function store(UsuarioController $Usuario)
    {
        $Dominio_Publico = env('FTP_FILES');
        $this->ID_Usuario = $Usuario->ID_Usuario;
        $this->Imagen = $this->generateByUsuarioId($this->ID_Usuario);
        $this->Nombre = $this->nameQR($Usuario);
        $this->Ruta_Local = 'qrcodes/' . $this->Nombre . $this->Tipo;
        $this->Ruta_Publica = $Dominio_Publico . $this->Ruta_Local;
        //Se almacena la imagen
        Storage::disk('public')->put($this->Ruta_Local, $this->Imagen);
        Storage::disk('ftp')->put($this->Ruta_Local, $this->Imagen);
        //Se obtiene la URL donde se almaceno la imagen
        $this->Ruta_Local = Storage::url($this->Ruta_Local);

        CodigoQR::create([
            'ID_Usuario' => $this->ID_Usuario,
            'Nombre' => $this->Nombre,
            'Ruta_Local' => $this->Ruta_Local,
            'Ruta_Publica' => $this->Ruta_Publica,
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
        $this->Ruta_Local = $ModeloQR->Ruta_Local;
        $this->Ruta_Publica = $ModeloQR->Ruta_Publica;
        $this->Tipo = $ModeloQR->Tipo;
        $this->Estatus = $ModeloQR->Estatus;

        return $this;
    }
}
