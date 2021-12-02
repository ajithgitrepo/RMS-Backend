<?php

namespace App\Imports;

use App\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;



use Illuminate\Support\Facades\DB;

class LeaveImport implements ToModel, WithHeadingRow, WithCalculatedFormulas
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */


    public function model(array $row)
    {

        //dd($row);

         return new Employee([
            'EMPLOYEE ID' => $row['EMPLOYEE ID'],
            'FULL NAME' => $row['FULL NAME'],
            'DESIGNATION' => $row['DESIGNATION'],
            'GENDER' => $row['GENDER'],
            'DOJ-FINAL' => $row['DOJ-FINAL'],
             'ANNUAL LEAVE BALANCE'=>$row['ANNUAL LEAVE BALANCE'],
             'ANNUAL LEAVE ACCURED'=>$row['ANNUAL LEAVE ACCURED'],
             'ANNUAL LEAVE AVAILED'=>$row['ANNUAL LEAVE AVAILED'],
             'MOL CONTRACT DATE-FINAL'=>$row['MOL CONTRACT DATE-FINAL'],
             'NO.YEARS'=>$row['NO.YEARS'],
             'SICK LEAVE'=>$row['SICK LEAVE']


         ]);

    }



}
