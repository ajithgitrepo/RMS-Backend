<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;


use Illuminate\Support\Facades\DB;

class UsersImport implements ToModel, WithHeadingRow,WithCalculatedFormulas

{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            //
            'Employee ID' => $customerArr['Employee ID'],
            'Employee First Name*' => $customerArr['Employee First Name*'],
            'Employee Last Name*' => $customerArr['Employee Last Name*'],

            'Gender' => $customerArr['Gender'],
            'DOJ' => $customerArr['DOJ'],
            'Location' => $customerArr['Location'],

            'Trade License
            (select from the drop down list)' => $customerArr['Trade License
            (select from the drop down list) Number'],
            'Person Code/MOL ID / Personnel Number (Max 14 digit)' => $customerArr['Person Code/MOL ID / Personnel Number (Max 14 digit) Name'],
            'Shop_Number' => $customerArr['Shop Number'],

            'Work permit No. / Labor Card No' => $customerArr['Work permit No. / Labor Card No'],
            'Job Title' => $customerArr['Job Title'],
            'Department' => $customerArr['Department'],

            'Mobile No. ' => $customerArr[$i]['Mobile No. '],
            'Work Contact Number' => $customerArr['Work Contact Number'],
            'Email' => $customerArr['Email'],
 
            'Marital Status' => $customerArr['Marital Status'],
            'Passport NO' => $customerArr['Passport NO'],
            'Passport Expiry' => $customerArr['Passport Expiry'],

            'Passport Expiry' => $customerArr['Passport Expiry'],

            'BUSINESS UNIT' => $customerArr['BUSINESS UNIT'],

            'LINE MANAGER 1' => $customerArr['LINE MANAGER 1'],


            
        ]);
    }
}
