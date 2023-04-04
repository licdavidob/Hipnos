<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Estacionamiento;

class EstacionamientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Estacionamiento::create([
            'Hash' => 'L5KgEJ6aVTHknSw',
            'ID_Tipo_Estacionamiento' => 1,
        ]);

        Estacionamiento::create([
            'Hash' => 'pEA9AlfEXQPfDko',
            'ID_Tipo_Estacionamiento' => 2,
        ]);

        Estacionamiento::create([
            'Hash' => 'M8K3IcQm4wSgHQS',
            'ID_Tipo_Estacionamiento' => 3,
        ]);
    }
}
