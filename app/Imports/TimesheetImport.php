<?php

namespace App\Imports;

use App\merchant_time_sheet;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Illuminate\Support\Facades\DB;

class TimesheetImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        //dd($row);

         return new merchant_time_sheet([
            'Employee' => $row['Employee'],
            'Outlet Name' => $row['Outlet Name'],
            'Month' => $row['Month'],
            'Day' => $row['Day'],
            'Year' => $row['Year']

        ]);

    }
}
