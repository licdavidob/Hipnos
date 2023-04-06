<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\CorreoControler;

use App\Models\Usuario;

class UsuarioController extends Controller
{
    public int $ID_Usuario;
    public string $Nombre;
    public string $Ap_Paterno;
    public string $Ap_Materno;
    public object $Tipo_Usuario;
    public object $Permiso;
    public ?string $Telefono;
    public ?string $Email;
    public ?object $QR;
    public int $Estatus;


    public function index()
    {
        $Usuarios = array();
        $Estadistica = array(
            "Alumno" => 0,
            "Docente" => 0,
            "Mixto" => 0,
        );

        $BusquedaUsuarios = Usuario::all();
        foreach ($BusquedaUsuarios as $Usuario) {
            $this->ModeltoObject($Usuario);
            $Usuarios[] = $this->getUsuario();
            $Estadistica[$this->Tipo_Usuario->Tipo_Usuario]++;
        }

        return view('Usuarios', compact('Usuarios', 'Estadistica'));
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'Nombre' => ['required', 'max:50'],
            'Ap_Paterno' => ['required', 'max:50'],
            'Ap_Materno' => ['max:50'],
            'ID_Tipo_Usuario' => ['required'],
            'Permiso.Inicio_Ingreso' => ['required', 'date'],
            'Permiso.Fin_Ingreso' => ['required', 'date'],
            'Telefono' => ['unique:usuario,Telefono', 'max:15', 'nullable'],
            'Email' => ['unique:usuario,Email', 'max:50', 'nullable', 'email',],
        ]);

        $PermisoRequest = $request->Permiso;
        $Permiso = new PermisoController();
        $Permiso->Inicio_Ingreso = $PermisoRequest['Inicio_Ingreso'];
        $Permiso->Fin_Ingreso = $PermisoRequest['Fin_Ingreso'];
        $Permiso->store($Permiso)->latestPermiso();

        Usuario::create([
            'Nombre' => $request->Nombre,
            'Ap_Paterno' => $request->Ap_Paterno,
            'Ap_Materno' => $request->Ap_Materno,
            'ID_Tipo_Usuario' => $request->ID_Tipo_Usuario,
            'ID_Permiso' => $Permiso->ID_Permiso,
            'Telefono' => $request->Telefono,
            'Email' => $request->Email,
        ]);

        $Usuario = $this->latestUsuario()->getUsuario();
        $QR = new GenerarQR();
        $QR->store($Usuario);

        if ($Usuario->Email) {
            $Usuario->QR = $QR;
            $Correo = new CorreoControler();
            $Correo->EnviarQR($Usuario);
        }

        return redirect()->route('Usuario.index');
    }


    public function show($id_usuario)
    {
        $BusquedaUsuario = $this->usuarioById($id_usuario);
        $Usuario = $this->modelToObject($BusquedaUsuario)->getUsuario();
        $QR = new GenerarQR();
        $QR->modelToObject($BusquedaUsuario->CodigoQR)->existsQR();
        $Usuario->QR = $QR;

        return view('Usuario', compact('Usuario'));
    }

    public function update(Request $request, $id_usuario)
    {
        $request->validate([
            'Nombre' => ['required', 'max:50'],
            'Ap_Paterno' => ['required', 'max:50'],
            'Ap_Materno' => ['max:50'],
            'ID_Tipo_Usuario' => ['required'],
            'Permiso.Inicio_Ingreso' => ['required', 'date'],
            'Permiso.Fin_Ingreso' => ['required', 'date'],
            //Permite actualizar un usuario con email y telefono unico
            //Tercer parametro: ID usuario
            //Cuarto parametro: Llave primaria
            'Telefono' => ['unique:usuario,Telefono,' . $id_usuario . ',ID_Usuario', 'max:15', 'nullable'],
            'Email' => ['unique:usuario,Email,' . $id_usuario . ',ID_Usuario', 'max:50', 'nullable', 'email'],
            'Estatus' => ['required', 'max:1'],
        ]);

        $BusquedaUsuario = $this->usuarioById($id_usuario);

        if ($BusquedaUsuario) {

            //Actualizar permiso
            $PermisoRequest = $request->Permiso;
            $Permiso = new PermisoController();
            $Permiso->Inicio_Ingreso = $PermisoRequest['Inicio_Ingreso'];
            $Permiso->Fin_Ingreso = $PermisoRequest['Fin_Ingreso'];
            $Permiso->update($BusquedaUsuario->ID_Permiso);

            //Actualizar Usuario
            $BusquedaUsuario->Nombre = $request->Nombre;
            $BusquedaUsuario->Ap_Paterno = $request->Ap_Paterno;
            $BusquedaUsuario->Ap_Materno = $request->Ap_Materno;
            $BusquedaUsuario->ID_Tipo_Usuario = $request->ID_Tipo_Usuario;
            $BusquedaUsuario->Telefono = $request->Telefono;
            $BusquedaUsuario->Email = $request->Email;
            $BusquedaUsuario->Estatus = $request->Estatus;
            $BusquedaUsuario->save();

            return true;
        }
        return false;
    }

    //TODO: Desarrollar el destroy, sirve para desaparecer de la tabla de usuarios
    public function destroy(string $id): void
    {
        //
    }

    public function latestUsuario(): static
    {
        $UsuarioInsertado = Usuario::latest('ID_Usuario')->first();
        $this->ModeltoObject($UsuarioInsertado);

        return $this;
    }

    public function usuarioById($id_usuario, $error404 = true)
    {
        $Busqueda = Usuario::find($id_usuario);

        if ($Busqueda) {
            return $Busqueda;
        }

        if ($error404) {
            return abort(404);
        }

        return false;
    }

    /**
     * @return UsuarioController
     */
    public function getUsuario(): UsuarioController
    {
        $Usuario = new UsuarioController();
        $Usuario->ID_Usuario = $this->ID_Usuario;
        $Usuario->Nombre = $this->Nombre;
        $Usuario->Ap_Paterno = $this->Ap_Paterno;
        $Usuario->Ap_Materno = $this->Ap_Materno;
        $Usuario->Tipo_Usuario = $this->Tipo_Usuario;
        $Usuario->Permiso = $this->Permiso;
        $Usuario->Telefono = $this->Telefono;
        $Usuario->Email = $this->Email;
        $Usuario->QR = $this->QR;
        $Usuario->Estatus = $this->Estatus;

        return $Usuario;
    }

    public function modelToObject($ModelUsuario)
    {
        $this->ID_Usuario = $ModelUsuario->ID_Usuario;
        $this->Nombre = $ModelUsuario->Nombre;
        $this->Ap_Paterno = $ModelUsuario->Ap_Paterno;
        $this->Ap_Materno = $ModelUsuario->Ap_Materno;
        $this->Tipo_Usuario = $ModelUsuario->Tipo_Usuario;
        $this->Permiso = $ModelUsuario->Permiso;
        $this->Telefono = $ModelUsuario->Telefono;
        $this->Email = $ModelUsuario->Email;
        $this->QR = $ModelUsuario->CodigoQR;
        $this->Estatus = $ModelUsuario->Estatus;

        return $this;
    }
}
