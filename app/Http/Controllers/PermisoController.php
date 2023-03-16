<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
        return Permiso::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermisoController $Permiso): static
    {
        Permiso::create([
            'Inicio_Ingreso' => $Permiso->Inicio_Ingreso,
            'Fin_Ingreso' => $Permiso->Fin_Ingreso,
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
        $BusquedaPermiso = Permiso::find($id);
        return $BusquedaPermiso;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermisoController $PermisoActualizado, int $idPermiso)
    {
        $BusquedaPermiso = $this->show($idPermiso);
        if ($BusquedaPermiso) {
            $BusquedaPermiso->Inicio_Ingreso = $PermisoActualizado->Inicio_Ingreso;
            $BusquedaPermiso->Fin_Ingreso = $PermisoActualizado->Fin_Ingreso;
            $BusquedaPermiso->save();
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


    public function RevisarHoyEnPermiso(PermisoController $Permiso)
    {
        $Hoy = Carbon::now();
        $IniciaIngreso = Carbon::parse($Permiso->Inicio_Ingreso);
        $FinIngreso = Carbon::parse($Permiso->Fin_Ingreso);

        $IniciaIngreso = strtotime($IniciaIngreso);
        $FinIngreso = strtotime($FinIngreso);
        $Hoy = strtotime($Hoy->toDateString());

        if (($Hoy >= $IniciaIngreso) && ($Hoy <= $FinIngreso)) {
            return true;
        } else {
            return false;
        }
    }
}
