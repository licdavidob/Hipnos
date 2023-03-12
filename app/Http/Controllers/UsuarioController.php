<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\PermisoController;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Nombre' => ['required','max:50'],
            'Ap_Paterno' => ['required', 'max:50'],
            'Ap_Materno' => ['max:50'],
            'ID_Tipo_Usuario' => ['required'],
            'Permiso.Inicio_Ingreso' => ['required', 'date'],
            'Permiso.Fin_Ingreso' => ['required', 'date'],
            'Telefono' => ['unique:usuario,Telefono', 'max:15'],
            'Email' => ['unique:usuario,Email','max:50','email'],
        ]);

        $Permiso = new PermisoController();
        $Permiso->store($request->Permiso);

        return $request;
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
}
