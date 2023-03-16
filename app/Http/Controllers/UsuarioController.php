<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\PermisoController;
use App\Models\Permiso;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    public int $ID_Usuario;
    public string $Nombre;
    public string $Ap_Paterno;
    public string $Ap_Materno;
    public $ID_Tipo_Usuario;
    public $ID_Permiso;
    public string $Telefono;
    public string $Email;
    public bool $Estatus;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Usuarios = array();
        $BusquedaUsuarios = Usuario::all();
        foreach ($BusquedaUsuarios as $Usuario) {
            $Usuario->ID_Permiso = $Usuario->Permiso;
            $Usuario->ID_Tipo_Usuario = $Usuario->Tipo_Usuario;
            $Usuarios[] = $Usuario;
        }

        return view('Usuario', compact('Usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // $request->validate([
        //     'Nombre' => ['required', 'max:50'],
        //     'Ap_Paterno' => ['required', 'max:50'],
        //     'Ap_Materno' => ['max:50'],
        //     'ID_Tipo_Usuario' => ['required'],
        //     'Permiso.Inicio_Ingreso' => ['required', 'date'],
        //     'Permiso.Fin_Ingreso' => ['required', 'date'],
        //     'Telefono' => ['unique:usuario,Telefono', 'max:15'],
        //     'Email' => ['unique:usuario,Email', 'max:50', 'email'],
        // ]);

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
        $this->extracted($UsuarioInsertado);

        return $this;
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id_usuario)
    {
        $BusquedaUsuario = Usuario::find($id_usuario);
        return $BusquedaUsuario;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // $request->validate([
        //     'ID_Usuario' => ['required', 'max:5'],
        //     'Nombre' => ['required', 'max:50'],
        //     'Ap_Paterno' => ['required', 'max:50'],
        //     'Ap_Materno' => ['max:50'],
        //     'ID_Tipo_Usuario' => ['required'],
        //     'Permiso.Inicio_Ingreso' => ['required', 'date'],
        //     'Permiso.Fin_Ingreso' => ['required', 'date'],
        //     'Telefono' => ['unique:usuario,Telefono', 'max:15'],
        //     'Email' => ['unique:usuario,Email', 'max:50', 'email'],
        //     'Estatus' => ['required', 'max:1'],
        // ]);

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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getUsuario()
    {
        $Usuario['ID_Usuario'] = $this->ID_Usuario;
        $Usuario['Nombre'] = $this->Nombre;
        $Usuario['Ap_Paterno'] = $this->Ap_Paterno;
        $Usuario['Ap_Materno'] = $this->Ap_Materno;
        $Usuario['ID_Tipo_Usuario'] = $this->ID_Tipo_Usuario;
        $Usuario['ID_Permiso'] = $this->ID_Permiso;
        $Usuario['Telefono'] = $this->Telefono;
        $Usuario['Email'] = $this->Email;
        $Usuario['Estatus'] = $this->Estatus;

        return $Usuario;
    }

    public function AccessParking(int $id_usuario)
    {
        //Se valida que el usuario exista
        if (!$this->show($id_usuario)) {
            return false;
        }

        //Se valida que el usuario sea activo
        if (!$this->Estatus) {
            return false;
        }

        //Se verifica que el permiso sea valido
        $Permiso = new PermisoController();
        $IniciaIngreso = $this->ID_Permiso->Inicio_Ingreso;
        $FinIngreso = $this->ID_Permiso->Fin_Ingreso;
        if (!$Permiso->RevisarHoyEnPermiso($IniciaIngreso, $FinIngreso)) {
            return "Permiso no válido";
        }

        return "Puedes continuar";
    }

    /**
     * @param $BusquedaUsuario
     * @return void
     */
    public function extracted($BusquedaUsuario): void
    {
        $this->ID_Usuario = $BusquedaUsuario->ID_Usuario;
        $this->Nombre = $BusquedaUsuario->Nombre;
        $this->Ap_Paterno = $BusquedaUsuario->Ap_Paterno;
        $this->Ap_Materno = $BusquedaUsuario->Ap_Materno;
        $this->ID_Tipo_Usuario = $BusquedaUsuario->ID_Tipo_Usuario;
        $this->ID_Permiso = $BusquedaUsuario->ID_Permiso;
        $this->Telefono = $BusquedaUsuario->Telefono;
        $this->Email = $BusquedaUsuario->Email;
        $this->Estatus = $BusquedaUsuario->Estatus;
    }
}
