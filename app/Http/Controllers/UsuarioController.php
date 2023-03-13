<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\PermisoController;

use App\Models\Usuario;

class UsuarioController extends Controller
{
    public int $ID_Usuario;
    public string $Nombre;
    public string $Ap_Paterno;
    public string $Ap_Materno;
    public int $ID_Tipo_Usuario;
    public int $ID_Permiso;
    public string $Telefono;
    public string $Email;
    public bool $Estatus;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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

        $Permiso = new PermisoController();
        $Permiso->store($request->Permiso)->latestPermiso();

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
        $PermisoInsertado = Usuario::latest('ID_Usuario')->first();
        $this->ID_Usuario = $PermisoInsertado->ID_Usuario;
        $this->Nombre = $PermisoInsertado->Nombre;
        $this->Ap_Paterno = $PermisoInsertado->Ap_Paterno;
        $this->Ap_Materno = $PermisoInsertado->Ap_Materno;
        $this->ID_Tipo_Usuario = $PermisoInsertado->ID_Tipo_Usuario;
        $this->ID_Permiso = $PermisoInsertado->ID_Permiso;
        $this->Telefono = $PermisoInsertado->Telefono;
        $this->Email = $PermisoInsertado->Email;
        $this->Estatus = $PermisoInsertado->Estatus;

        return $this;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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
}
