<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\EstacionamientoController;

class ParkingController extends Controller
{
    private array $UsuarioType = array('Alumno', 'Docente', 'Mixto');
    private array $EstacionamientoType = array('Alumno', 'Docente', 'Mixto');
    private array $AccessParking = array(
        //Estacionamiento => array(Tipo de Usuario)
        'Alumno' => array('Alumno', 'Mixto'),
        'Docente' => array('Docente', 'Mixto'),
        'Mixto' => array('Alumno', 'Docente', 'Mixto'),
    );

    public function Access($IdUsuario, $HashEstacionamiento)
    {
        $Usuario = new UsuarioController();
        $BusquedaUsuario = $Usuario->usuarioById($IdUsuario, false);

        //Se valida que el usuario exista
        if (!$BusquedaUsuario) {
            return false;
        }

        //Se valida que el usuario sea activo
        if (!$BusquedaUsuario->Estatus) {
            return false;
        }

        //Se verifica que el permiso sea valido
        $Permiso = new PermisoController();
        $Permiso->Inicio_Ingreso = $BusquedaUsuario->Permiso->Inicio_Ingreso;
        $Permiso->Fin_Ingreso = $BusquedaUsuario->Permiso->Fin_Ingreso;
        if (!$Permiso->reviewToday()) {
            return false;
        }

        //Se valida que el tipo de usuario pueda acceder al estacionamiento
        if (!$this->accessEstacionamientoTypeByUsuarioType($HashEstacionamiento, $BusquedaUsuario->Tipo_Usuario->Tipo_Usuario)) {
            return false;
        }

        return true;
    }

    public function accessEstacionamientoTypeByUsuarioType($HashEstacionamiento, $TipoUsuario)
    {
        //Se valida que exista estacionamiento
        $Estacionamiento = new EstacionamientoController();
        $Busqueda = $Estacionamiento->estacionamientoByHash($HashEstacionamiento, false);
        if (!$Busqueda) {
            return false;
        }

        //Se valida el tipo de estacionamiento
        $Estacionamiento->modelToObject($Busqueda);
        if (!in_array($Estacionamiento->TipoEstacionamiento, $this->EstacionamientoType)) {
            return false;
        }

        //Se valida el tipo de usuario
        if (!in_array($TipoUsuario, $this->UsuarioType)) {
            return false;
        }

        //Se valida que el tipo de usuario pueda acceder al estacionamiento
        if (!in_array($TipoUsuario, $this->AccessParking[$Estacionamiento->TipoEstacionamiento])) {
            return false;
        }

        return true;
    }
}
