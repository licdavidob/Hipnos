<?php

namespace App\Imports;

use App\Models\Modelo;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ModeloImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return Modelo::create([
            'Modelo' => $row['modelo'],
            'ID_Marca' => $row['id_marca'],
        ]);
    }
}
