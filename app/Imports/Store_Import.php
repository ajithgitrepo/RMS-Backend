<?php

namespace App\Imports;

use App\Outlet;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Illuminate\Support\Facades\DB;

class Store_Import implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        //dd($row);

         return new Outlet([
            'outlet_name' => $row['outlet_name'],
            'outlet_lat' => $row['outlet_lat'],
            'outlet_long' => $row['outlet_long'],
            'outlet_area' => $row['outlet_area'],
            'outlet_city' => $row['outlet_city'],
            'outlet_state' => $row['outlet_state'],
            'outlet_country' => $row['outlet_country']

        ]);

    }
}
