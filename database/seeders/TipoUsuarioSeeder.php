<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tipo_Usuario;

class TipoUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Tipo_Usuario::create([
            'Tipo_Usuario' => 'Alumno',
        ]);
        Tipo_Usuario::create([
            'Tipo_Usuario' => 'Docente',
        ]);
        Tipo_Usuario::create([
            'Tipo_Usuario' => 'Invitado',
        ]);
    }
}
