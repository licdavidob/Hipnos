<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use Illuminate\Http\Request;

class PermisoController extends Controller
{
    public int $ID_Permiso;
    public string $Inicio_Ingreso;
    public string $Fin_Ingreso;
    public bool $Estatus;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($Permiso): static
    {
        Permiso::create([
            'Inicio_Ingreso' => $Permiso['Inicio_Ingreso'],
            'Fin_Ingreso' => $Permiso['Fin_Ingreso'],
        ]);

        return $this;
    }

    public function latestPermiso(): static
    {
        $PermisoInsertado = Permiso::latest('ID_Permiso')->first();
        $this->ID_Permiso = $PermisoInsertado->ID_Permiso;
        $this->Inicio_Ingreso = $PermisoInsertado->Inicio_Ingreso;
        $this->Fin_Ingreso = $PermisoInsertado->Fin_Ingreso;
        $this->Estatus = $PermisoInsertado->Estatus;

        return $this;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $BusquedaPermiso = Permiso::findOrFail($id);
        $this->ID_Permiso = $BusquedaPermiso->ID_Permiso;
        $this->Inicio_Ingreso = $BusquedaPermiso->Inicio_Ingreso;
        $this->Fin_Ingreso = $BusquedaPermiso->Fin_Ingreso;
        $this->Estatus = $BusquedaPermiso->Estatus;

        return $this;
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

    public function getPermiso()
    {
        $Permiso['ID_Permiso'] = $this->ID_Permiso;
        $Permiso['Inicio_Ingreso'] = $this->Inicio_Ingreso;
        $Permiso['Fin_Ingreso'] = $this->Fin_Ingreso;
        $Permiso['Estatus'] = $this->Estatus;

        return $Permiso;
    }
}
