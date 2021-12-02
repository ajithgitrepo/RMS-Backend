<?php

namespace App\Imports;

use App\promotion;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Illuminate\Support\Facades\DB;

class PromoImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        //dd($row);

         return new promotion([
            'outlet' => $row['outlet'],
            'product' => $row['product'],
            'from_date' => $row['from_date'],
            'to_date' => $row['to_date'],
            'description' => $row['description']

        ]);

    }
}
