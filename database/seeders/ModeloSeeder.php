<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Imports\ModeloImport;
use Maatwebsite\Excel\Facades\Excel;

class ModeloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Excel::import(new ModeloImport, 'Cat_Modelo.xlsx');
    }
}
