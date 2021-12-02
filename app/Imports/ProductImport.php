<?php

namespace App\Imports;

use App\Product_details;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Illuminate\Support\Facades\DB;

class ProductImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        //dd($row);

         return new Product_details([
            'sku' => $row['sku'],
            'product_name' => $row['product_name'],
            'type' => $row['type'],
            'zrep_code' => $productArr[0][$i]['zrep_code'],
            'barcode' => $row['barcode'],
            'piece_per_carton' => $row['piece_per_carton'],
            'price_per_piece' => $row['price_per_piece'],
            'brand_id' => $row['brand_id'],

            'product_categories' => $row['product_categories'],
            'remarks' => $row['remarks'],
            'range' => $row['range'],

            'updated_at'  => date('y-m-d H:i:s'),
            'created_at' => date('y-m-d H:i:s')

        ]);

    }
}
