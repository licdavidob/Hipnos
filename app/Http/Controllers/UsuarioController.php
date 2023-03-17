<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\PermisoController;
use App\Models\Permiso;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    public int $ID_Usuario;
    public string $Nombre;
    public string $Ap_Paterno;
    public string $Ap_Materno;
    public object $Tipo_Usuario;
    public object $Permiso;
    public string $Telefono;
    public string $Email;
    public bool $Estatus;


    public function index()
    {
        $Usuarios = array();
        $BusquedaUsuarios = Usuario::all();
        foreach ($BusquedaUsuarios as $Usuario) {
            $this->ModeltoObject($Usuario);
            $Usuarios[] = $this->getUsuario();
        }

        return view('Usuario', compact('Usuarios'));
    }


    /**
     * @param Request $request
     * @return $this
     */
    public function store(Request $request): static
    {
        $request->validate([
            'Nombre' => ['required', 'max:50'],
            'Ap_Paterno' => ['required', 'max:50'],
            'Ap_Materno' => ['max:50'],
            'ID_Tipo_Usuario' => ['required'],
            'Permiso.Inicio_Ingreso' => ['required', 'date'],
            'Permiso.Fin_Ingreso' => ['required', 'date'],
            'Telefono' => ['unique:usuario,Telefono', 'max:15'],
            'Email' => ['unique:usuario,Email', 'max:50', 'email'],
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

        return $this;
    }

    public function latestUsuario(): static
    {
        $UsuarioInsertado = Usuario::latest('ID_Usuario')->first();
        $this->ModeltoObject($UsuarioInsertado);

        return $this;
    }


    /**
     * @param int $id_usuario
     * @return false
     */
    public function show(int $id_usuario): mixed
    {
        $BusquedaUsuario = Usuario::find($id_usuario);
        if ($BusquedaUsuario) {
            return $BusquedaUsuario;
        }
        return false;
    }


    /**
     * @param Request $request
     * @return bool
     */
    public function update(Request $request): bool
    {
        $request->validate([
            'ID_Usuario' => ['required', 'max:5'],
            'Nombre' => ['required', 'max:50'],
            'Ap_Paterno' => ['required', 'max:50'],
            'Ap_Materno' => ['max:50'],
            'ID_Tipo_Usuario' => ['required'],
            'Permiso.Inicio_Ingreso' => ['required', 'date'],
            'Permiso.Fin_Ingreso' => ['required', 'date'],

            //Permite actualizar un usuario con email y telefono unico
            //Tercer parametro: ID usuario
            //Cuarto parametro: Llave primaria
            'Telefono' => ['unique:usuario,Telefono,' . $request->input('ID_Usuario') . ',ID_Usuario', 'max:15'],
            'Email' => ['unique:usuario,Email,' . $request->input('ID_Usuario') . ',ID_Usuario', 'max:50', 'email'],
            'Estatus' => ['required', 'max:1'],
        ]);

        $BusquedaUsuario = $this->show($request->ID_Usuario);
        if ($BusquedaUsuario) {

            //Actualizar permiso
            $PermisoRequest = $request->Permiso;
            $Permiso = new PermisoController();
            $Permiso->Inicio_Ingreso = $PermisoRequest['Inicio_Ingreso'];
            $Permiso->Fin_Ingreso = $PermisoRequest['Fin_Ingreso'];
            $Permiso->update($Permiso, $BusquedaUsuario->ID_Permiso);

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


    /**
     * @param string $id
     * @return void
     */
    public function destroy(string $id): void
    {
        //
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
        $Usuario->Estatus = $this->Estatus;

        return $Usuario;
    }

    /**
     * @param $ModelUsuario
     * @return void
     */
    public function ModeltoObject($ModelUsuario): void
    {
        $this->ID_Usuario = $ModelUsuario->ID_Usuario;
        $this->Nombre = $ModelUsuario->Nombre;
        $this->Ap_Paterno = $ModelUsuario->Ap_Paterno;
        $this->Ap_Materno = $ModelUsuario->Ap_Materno;
        $this->Tipo_Usuario = $ModelUsuario->Tipo_Usuario;
        $this->Permiso = $ModelUsuario->Permiso;
        $this->Telefono = $ModelUsuario->Telefono;
        $this->Email = $ModelUsuario->Email;
        $this->Estatus = $ModelUsuario->Estatus;
    }


    /**
     * @param int $id_usuario
     * @return bool
     */
    public function AccessParking(int $id_usuario): bool
    {
        //Se valida que el usuario exista
        $BusquedaUsuario = $this->show($id_usuario);
        if (!$BusquedaUsuario) {
            return false;
        }

        //Se transforma el modelo usuario a objeto
        $this->ModeltoObject($BusquedaUsuario);

        //Se valida que el usuario sea activo
        if (!$this->Estatus) {
            return false;
        }

        //Se verifica que el permiso sea valido
        $Permiso = new PermisoController();
        $Permiso->Inicio_Ingreso = $this->Permiso->Inicio_Ingreso;
        $Permiso->Fin_Ingreso = $this->Permiso->Fin_Ingreso;
        if (!$Permiso->RevisarHoyEnPermiso($Permiso)) {
            return false;
        }

        return true;
    }
}
