<?php

namespace App\Imports;

use App\Outlet;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

use Illuminate\Support\Facades\DB;

class OutletImport implements ToModel, WithHeadingRow,WithCalculatedFormulas

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
            'outlet_country' => $row['outlet_country'],
            'account'=>$row['account'],

            'updated_at'  => date('y-m-d H:i:s'),
            'created_at' => date('y-m-d H:i:s')

        ]);

    }
}
