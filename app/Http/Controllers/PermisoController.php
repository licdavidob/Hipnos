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
        $Permisos = array();
        $BusquedaPermiso = Permiso::all();
        foreach ($BusquedaPermiso as $Permiso) {
            $this->ModeltoObject($Permiso);
            $Permisos[] = $this->getPermiso();
        }

        return $Permisos;
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
        $this->ModeltoObject($PermisoInsertado);

        return $this;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id_permiso)
    {
        $BusquedaPermiso = Permiso::find($id_permiso);
        if ($BusquedaPermiso) {
            return $BusquedaPermiso;
        }
        return false;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(int $idPermiso)
    {
        $BusquedaPermiso = $this->show($idPermiso);
        if ($BusquedaPermiso) {
            $BusquedaPermiso->Inicio_Ingreso = $this->Inicio_Ingreso;
            $BusquedaPermiso->Fin_Ingreso = $this->Fin_Ingreso;
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

    private function getPermiso(): PermisoController
    {
        $Permiso = new PermisoController();
        $Permiso->ID_Permiso = $this->ID_Permiso;
        $Permiso->Inicio_Ingreso = $this->Inicio_Ingreso;
        $Permiso->Fin_Ingreso = $this->Fin_Ingreso;
        $Permiso->Estatus = $this->Estatus;

        return $Permiso;
    }

    public function modelToObject($ModelPermiso): void
    {
        $this->ID_Permiso = $ModelPermiso->ID_Permiso;
        $this->Inicio_Ingreso = $ModelPermiso->Inicio_Ingreso;
        $this->Fin_Ingreso = $ModelPermiso->Fin_Ingreso;
        $this->Estatus = $ModelPermiso->Estatus;
    }


    public function reviewToday(): bool
    {
        $Hoy = Carbon::now();
        $IniciaIngreso = Carbon::parse($this->Inicio_Ingreso);
        $FinIngreso = Carbon::parse($this->Fin_Ingreso);

        $IniciaIngreso = strtotime($IniciaIngreso);
        $FinIngreso = strtotime($FinIngreso);
        $Hoy = strtotime($Hoy->toDateString());

        //Se valida que el dia actual se encuentre dentro del permiso
        if (($Hoy >= $IniciaIngreso) && ($Hoy <= $FinIngreso)) {
            return true;
        } else {
            return false;
        }
    }
}
