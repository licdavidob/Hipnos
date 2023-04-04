<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tipo_Estacionamiento;

class TipoEstacionamientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tipo_Estacionamiento::create([
            'Tipo_Estacionamiento' => 'Alumno',
        ]);
        Tipo_Estacionamiento::create([
            'Tipo_Estacionamiento' => 'Docente',
        ]);
        Tipo_Estacionamiento::create([
            'Tipo_Estacionamiento' => 'Mixto',
        ]);
    }
}
