<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Foundation\Auth\RegistersUsers;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use Illuminate\Support\Facades\Mail;

class monthly_stock extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'monthly_stock:monthly_stock';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
//                \Log::info('666666');

        $start = new Carbon('first day of last month');
        $end = new Carbon('last day of last month');


        $month = date('F', strtotime($start));
//        \Log::info($month);


//        \Log::info($start);
//        \Log::info($end);

        for ($i = 0; $i <= 6; $i++)
        {
            if ($i == 0)
            {
                $date=[$start, $end];
//                 \Log::info($date);
                $availability = DB::table('availability')
                    ->leftJoin('employee', 'employee.employee_id', '=', 'availability.created_by')
                    ->leftJoin('outlet', 'outlet.outlet_id', '=', 'availability.outlet_id')
                    ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
                    ->leftJoin('product_details', 'product_details.id', '=', 'availability.product_id')
                    ->select('availability.*', 'product_details.zrep_code', 'product_details.sku', 'employee.first_name', 'employee.employee_id', 'store_details.store_name', 'store_details.store_code', 'store_details.address')
//                    ->whereDate('date',$date)
                    ->whereBetween('date', [$start, $end])
                    ->orderBy('date','asc')
                    ->where('availability.is_active', 1)->get();
//                \Log::info($availability);


                //\Log::info($total_timesheets[0]->employee->first_name.' '.$cde_first_name);

//                 $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet()->setTitle('Availability');
                $sheet->setCellValue('A1',"Month");
                $sheet->setCellValue('B1',$month);
//                \Log::info($sheet->setCellValue('A1', date('F', strtotime($start))));
                $sheet->setCellValue('D1', 'Availability');

                $sheet->setCellValue('A3', 'Date');
                $sheet->setCellValue('B3', 'Store Code');
                $sheet->setCellValue('C3', 'Outlet Name');
                $sheet->setCellValue('D3', 'City');

                $sheet->setCellValue('E3', 'Merchandiser');

                $sheet->setCellValue('F3', 'Category');
                $sheet->setCellValue('G3', 'Product');

                $sheet->setCellValue('H3', 'Zrep');
                $sheet->setCellValue('I3', 'SKU');

                $sheet->setCellValue('J3', 'Status');
                $sheet->setCellValue('K3', 'Reason');

                $rows = 4;


                foreach ($availability as $avail)
                {
                    $sheet->setCellValue('A' . $rows, date('d-m-Y', strtotime($avail->date)));

                    $sheet->setCellValue('B' . $rows, $avail->store_code);

                    $sheet->setCellValue('C' . $rows, $avail->store_name);
                    $sheet->setCellValue('D' . $rows, (isset($avail->outlet->outlet_city) ? $avail->outlet->outlet_city : '-'));
                    $sheet->setCellValue('E' . $rows, $avail->first_name);
                    $sheet->setCellValue('F' . $rows, $avail->category_name);
                    $sheet->setCellValue('G' . $rows, $avail->product_name);

                    $sheet->setCellValue('H' . $rows, $avail->zrep_code);
                    $sheet->setCellValue('I' . $rows, $avail->sku);
                    if ($avail->is_available=='1')
                        $sheet->setCellValue('J' . $rows, 'Available');
                    else
                        $sheet->setCellValue('J' . $rows, 'Not Available');
                    if (isset($avail->reason))
                        $sheet->setCellValue('K' . $rows, $avail->reason);
                    else
                        $sheet->setCellValue('K' . $rows, '-');

                    $rows++;
                }


            }
//
            if ($i == 1) {
//                $date = Carbon::now()->subDays(1);
//                 \Log::info($date);
                $visibility = DB::table('visibility')
                    ->leftJoin('employee', 'employee.employee_id', '=', 'visibility.created_by')
                    ->leftJoin('outlet', 'outlet.outlet_id', '=', 'visibility.outlet_id')
                    ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
                    ->select('visibility.*', 'employee.first_name', 'employee.employee_id', 'store_details.store_name', 'store_details.store_code', 'store_details.address')
//                    ->whereDate('date', $date)
                    ->whereBetween('date', [$start, $end])
                    ->orderBy('date','asc')

                    ->where('visibility.is_active', 1)->get();

                $spreadsheet->createSheet();
                $spreadsheet->setActiveSheetIndex(1);
                $sheet1 = $spreadsheet->getActiveSheet()->setTitle('Visibility');
                $sheet1->setCellValue('A1',"Month");

                $sheet1->setCellValue('B1', $month);
                $sheet1->setCellValue('D1', 'Visibility');

                $sheet1->setCellValue('A3', 'Date');
                $sheet1->setCellValue('B3', 'Store Code');
                $sheet1->setCellValue('C3', 'Outlet Name');
                $sheet1->setCellValue('D3', 'City');

                $sheet1->setCellValue('E3', 'Merchandiser');

                $sheet1->setCellValue('F3', 'Category');

                $sheet1->setCellValue('G3', 'Image');
                $sheet1->setCellValue('H3', 'Reason');

                $rows = 4;


                foreach ($visibility as $visi) {
                    $sheet1->setCellValue('A' . $rows, date('d-m-Y', strtotime($visi->date)));

                    $sheet1->setCellValue('B' . $rows, $visi->store_code);

                    $sheet1->setCellValue('C' . $rows, $visi->store_name);
                    $sheet1->setCellValue('D' . $rows, (isset($stock->outlet->outlet_city) ? $visi->outlet->outlet_city : '-'));
                    $sheet1->setCellValue('E' . $rows, $visi->first_name);
                    $sheet1->setCellValue('F' . $rows, $visi->category_name);

                    if (isset($visi->image_url))
                        $sheet1->setCellValue('G' . $rows, 'https://rms2.rhapsody.ae/visibility_image/' . $visi->image_url);
                    else
                        $sheet1->setCellValue('G' . $rows, '-');
                    if (isset($visi->reason))
                        $sheet1->setCellValue('H' . $rows, $visi->reason);
                    else
                        $sheet1->setCellValue('H' . $rows, '-');

                    $rows++;
                }


            }


            if ($i == 2) {
//                $date = Carbon::now()->subDays(1);
//                 \Log::info($date);
                $shareof_shelf = DB::table('shareof_shelf')
                    ->leftJoin('employee', 'employee.employee_id', '=', 'shareof_shelf.created_by')
                    ->leftJoin('outlet', 'outlet.outlet_id', '=', 'shareof_shelf.outlet_id')
                    ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
                    ->select('shareof_shelf.*', 'employee.first_name', 'employee.employee_id', 'store_details.store_name', 'store_details.store_code', 'store_details.address')
//                    ->whereDate('date', $date)
                    ->whereBetween('date', [$start, $end])
                    ->orderBy('date','asc')

                    ->where('shareof_shelf.is_active', 1)->get();
//                 \Log::info($availability);


                //\Log::info($total_timesheets[0]->employee->first_name.' '.$cde_first_name);
                $spreadsheet->createSheet();
                $spreadsheet->setActiveSheetIndex(2);
                $sheet2 = $spreadsheet->getActiveSheet()->setTitle('Share Of Shelf');
                $sheet2->setCellValue('A1',"Month");

                $sheet2->setCellValue('B1',$month);
                $sheet2->setCellValue('D1', 'Share Of Shelf');

                $sheet2->setCellValue('A3', 'Date');
                $sheet2->setCellValue('B3', 'Store Code');
                $sheet2->setCellValue('C3', 'Outlet Name');
                $sheet2->setCellValue('D3', 'City');

                $sheet2->setCellValue('E3', 'Merchandiser');

                $sheet2->setCellValue('F3', 'Category');

                $sheet2->setCellValue('G3', 'Total Shelf');
                $sheet2->setCellValue('H3', 'Actual Shelf');

                $sheet2->setCellValue('I3', 'Total Target');
                $sheet2->setCellValue('J3', 'Actual Target');
                $sheet2->setCellValue('K3', 'Reason');

                $rows = 4;


                foreach ($shareof_shelf as $share) {
                    $sheet2->setCellValue('A' . $rows, date('d-m-Y', strtotime($share->date)));

                    $sheet2->setCellValue('B' . $rows, $share->store_code);

                    $sheet2->setCellValue('C' . $rows, $share->store_name);
                    $sheet2->setCellValue('D' . $rows, (isset($share->outlet->outlet_city) ? $share->outlet->outlet_city : '-'));
                    $sheet2->setCellValue('E' . $rows, $share->first_name);
                    $sheet2->setCellValue('F' . $rows, $share->category_name);
                    $sheet2->setCellValue('G' . $rows, $share->total_share);
                    $sheet2->setCellValue('H' . $rows, $share->share);
                    $sheet2->setCellValue('I' . $rows, $share->target);
                    $sheet2->setCellValue('J' . $rows, $share->actual);
                    if (isset($share->reason))
                        $sheet2->setCellValue('K' . $rows, $share->reason);
                    else
                        $sheet2->setCellValue('K' . $rows, '-');

                    $rows++;
                }


            }

            if ($i == 3) {
//                $date = Carbon::now()->subDays(1);
//                 \Log::info($date);
                $promotion_check = DB::table('promotion_check')
                    ->leftJoin('employee', 'employee.employee_id', '=', 'promotion_check.created_by')
                    ->leftJoin('outlet', 'outlet.outlet_id', '=', 'promotion_check.outlet_id')
                    ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
                    ->select('promotion_check.*', 'employee.first_name', 'employee.employee_id', 'store_details.store_name', 'store_details.store_code', 'store_details.address')
//                    ->whereDate('promotion_check.created_at', $date)
                    ->whereBetween('promotion_check.created_at', [$start, $end])
                    ->orderBy('promotion_check.created_at','asc')

                    ->where('promotion_check.is_active', 1)->get();
//                 \Log::info($promotion_check);


                //\Log::info($total_timesheets[0]->employee->first_name.' '.$cde_first_name);

                $spreadsheet->createSheet();
                $spreadsheet->setActiveSheetIndex(3);
                $sheet3 = $spreadsheet->getActiveSheet()->setTitle('Promotion Check');
                $sheet3->setCellValue('A1',"Month");

                $sheet3->setCellValue('B1',$month);
                $sheet3->setCellValue('D1', 'Promotion Check');

                $sheet3->setCellValue('A3', 'Date');
                $sheet3->setCellValue('B3', 'Store Code');
                $sheet3->setCellValue('C3', 'Outlet Name');
                $sheet3->setCellValue('D3', 'City');

                $sheet3->setCellValue('E3', 'Merchandiser');

//                 $sheet->setCellValue('E2', 'Product');

                $sheet3->setCellValue('F3', 'Available');
                $sheet3->setCellValue('G3', 'Reason');

                $rows = 4;


                foreach ($promotion_check as $promo) {
                    $sheet3->setCellValue('A' . $rows, date('d-m-Y', strtotime($promo->created_at)));

                    $sheet3->setCellValue('B' . $rows, $promo->store_code);

                    $sheet3->setCellValue('C' . $rows, $promo->store_name);
                    $sheet3->setCellValue('D' . $rows, (isset($promo->outlet->outlet_city) ? $promo->outlet->outlet_city : '-'));
                    $sheet3->setCellValue('E' . $rows, $promo->first_name);
//                     $sheet3->setCellValue('E' . $rows, $avail->product_name );

                    if ($promo->is_available=='1')
                        $sheet3->setCellValue('F' . $rows, 'Available');
                    else
                        $sheet3->setCellValue('F' . $rows, 'Not Available');
                    if (isset($promo->reason))
                        $sheet3->setCellValue('G' . $rows, $promo->reason);
                    else
                        $sheet3->setCellValue('G' . $rows, '-');

                    $rows++;
                }


            }

            if ($i == 4) {
//                $date = Carbon::now()->subDays(1);
//                 \Log::info($date);
                $planogram_checks = DB::table('planogram_checks')
                    ->leftJoin('employee', 'employee.employee_id', '=', 'planogram_checks.created_by')
                    ->leftJoin('outlet', 'outlet.outlet_id', '=', 'planogram_checks.outlet_id')
                    ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
                    ->select('planogram_checks.*', 'employee.first_name', 'employee.employee_id', 'store_details.store_name', 'store_details.store_code', 'store_details.address')
//                    ->whereDate('date', $date)
                    ->whereBetween('date', [$start, $end])
                    ->orderBy('date','asc')

                    ->where('planogram_checks.is_active', 1)->get();
//                 \Log::info($availability);


                //\Log::info($total_timesheets[0]->employee->first_name.' '.$cde_first_name);

                $spreadsheet->createSheet();
                $spreadsheet->setActiveSheetIndex(4);
                $sheet4 = $spreadsheet->getActiveSheet()->setTitle('Planogram');
                $sheet4->setCellValue('A1',"Month");

                $sheet4->setCellValue('B1', $month);
                $sheet4->setCellValue('D1', 'Planogram ');

                $sheet4->setCellValue('A3', 'Date');
                $sheet4->setCellValue('B3', 'Store Code');
                $sheet4->setCellValue('C3', 'Outlet Name');
                $sheet4->setCellValue('D3', 'City');

                $sheet4->setCellValue('E3', 'Merchandiser');

                $sheet4->setCellValue('F3', 'Category');

                $sheet4->setCellValue('G3', 'Before Image');
                $sheet4->setCellValue('H3', 'After Image');

                $rows = 4;


                foreach ($planogram_checks as $plano) {
                    $sheet4->setCellValue('A' . $rows, date('d-m-Y', strtotime($plano->date)));

                    $sheet4->setCellValue('B' . $rows, $plano->store_code);

                    $sheet4->setCellValue('C' . $rows, $plano->store_name);
                    $sheet4->setCellValue('D' . $rows, (isset($plano->outlet->outlet_city) ? $plano->outlet->outlet_city : '-'));
                    $sheet4->setCellValue('E' . $rows, $plano->first_name);
                    $sheet4->setCellValue('F' . $rows, $plano->category_name);

                    if (isset($plano->before_image))
                        $sheet4->setCellValue('G' . $rows, "https://rms2.rhapsody.ae/planogram_image/" . $plano->before_image);
                    else
                        $sheet4->setCellValue('G' . $rows, '-');
                    if (isset($plano->after_image))
                        $sheet4->setCellValue('H' . $rows, 'https://rms2.rhapsody.ae/planogram_image/' . $plano->after_image);
                    else
                        $sheet4->setCellValue('H' . $rows, '-');

                    $rows++;
                }


            }

            if ($i == 5) {
//                $date = Carbon::now()->subDays(1);
//                 \Log::info($date);
                $competitor = DB::table('competitor')
                    ->leftJoin('employee', 'employee.employee_id', '=', 'competitor.created_by')
                    ->leftJoin('outlet', 'outlet.outlet_id', '=', 'competitor.outlet_id')
                    ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
                    ->select('competitor.*', 'employee.first_name', 'employee.employee_id', 'store_details.store_name', 'store_details.store_code', 'store_details.address')
//                    ->whereDate('competitor.created_at', $date)
                    ->whereBetween('competitor.created_at', [$start, $end])
                    ->orderBy('competitor.created_at','asc')

                    ->where('competitor.is_active', 1)->get();
//                 \Log::info($availability);


                //\Log::info($total_timesheets[0]->employee->first_name.' '.$cde_first_name);

//                 $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
                $spreadsheet->createSheet();
                $spreadsheet->setActiveSheetIndex(5);
                $sheet5 = $spreadsheet->getActiveSheet()->setTitle('Competitor');
                $sheet5->setCellValue('A1',"Month");

                $sheet5->setCellValue('B1',$month);
                $sheet5->setCellValue('D1', 'Competitor Info');

                $sheet5->setCellValue('A3', 'Date');
                $sheet5->setCellValue('B3', 'Store Code');
                $sheet5->setCellValue('C3', 'Outlet Name');
                $sheet5->setCellValue('D3', 'City');

                $sheet5->setCellValue('E3', 'Merchandiser');

                $sheet5->setCellValue('F3', 'Company Name');

                $sheet5->setCellValue('G3', 'Brand Name');
//                $sheet5->setCellValue('H3', 'Category Name');

                $sheet5->setCellValue('H3', 'Item Name');
                $sheet5->setCellValue('I3', 'Promotion Type');

                $sheet5->setCellValue('K3', 'Regular Price');
                $sheet5->setCellValue('K3', 'Selling Price');

                $rows = 4;


                foreach ($competitor as $comp) {
                    $sheet5->setCellValue('A' . $rows, date('d-m-Y', strtotime($comp->created_at)));

                    $sheet5->setCellValue('B' . $rows, $comp->store_code);

                    $sheet5->setCellValue('C' . $rows, $comp->store_name);
                    $sheet5->setCellValue('D' . $rows, (isset($comp->outlet->outlet_city) ? $comp->outlet->outlet_city : '-'));

                    $sheet5->setCellValue('E' . $rows, $comp->first_name);
                    $sheet5->setCellValue('F' . $rows, $comp->company_name);


                    $sheet5->setCellValue('G' . $rows, $comp->brand_name);
//                    $sheet5->setCellValue('H' . $rows, $comp->category_name);
                    $sheet5->setCellValue('H' . $rows, $comp->item_name);
                    $sheet5->setCellValue('I' . $rows, $comp->promotion_type);
                    $sheet5->setCellValue('J' . $rows, $comp->mrp);
                    $sheet5->setCellValue('K' . $rows, $comp->selling_price);


                    $rows++;
                }


            }

            if ($i == 6) {
                $date = Carbon::now()->subDays(1);
//                 \Log::info($date);
                $outlet_stockexpiry = DB::table('outlet_stockexpiry')
                    ->leftJoin('employee', 'employee.employee_id', '=', 'outlet_stockexpiry.created_by')
                    ->leftJoin('outlet', 'outlet.outlet_id', '=', 'outlet_stockexpiry.outlet_id')
                    ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
                    ->leftJoin('product_details', 'product_details.id', '=', 'outlet_stockexpiry.product_id')
                    ->leftJoin('category_details', 'category_details.id', '=', 'product_details.product_categories')
                    ->select('outlet_stockexpiry.*', 'product_details.barcode','product_details.product_name', 'category_details.category_name', 'product_details.zrep_code', 'product_details.sku', 'employee.first_name', 'employee.employee_id', 'store_details.store_name', 'store_details.store_code', 'store_details.address')
//                    ->whereDate('date', $date)
                    ->whereBetween('date', [$start, $end])
                    ->orderBy('date','asc')

                    ->where('outlet_stockexpiry.is_active', 1)->get();
//                 \Log::info($availability);


                $spreadsheet->createSheet();
                $spreadsheet->setActiveSheetIndex(6);
                $sheet6 = $spreadsheet->getActiveSheet()->setTitle('Stock Expiry');
                $sheet6->setCellValue('A1',"Month");

                $sheet6->setCellValue('B1', $month);
                $sheet6->setCellValue('D1', 'Outlet Stock Expiry Report');

                $sheet6->setCellValue('A3', 'Date');
                $sheet6->setCellValue('B3', 'Store Code');
                $sheet6->setCellValue('C3', 'Outlet Name');
                $sheet6->setCellValue('D3', 'City');

                $sheet6->setCellValue('E3', 'Merchandiser');

                $sheet6->setCellValue('F3', 'Category');
                $sheet6->setCellValue('G3', 'Product');

                $sheet6->setCellValue('H3', 'Zrep');
                $sheet6->setCellValue('I3', 'SKU');
                $sheet6->setCellValue('J3', 'Barcode');

                $sheet6->setCellValue('K3', 'Expiry Date');
                $sheet6->setCellValue('L3', 'Price');

                $sheet6->setCellValue('M3', 'Near Expiry Qty');
                $sheet6->setCellValue('N3', 'Exposure Ouantity');
                $sheet6->setCellValue('O3', 'Account');


                $sheet6->setCellValue('P3', 'Type');
                $sheet6->setCellValue('Q3', 'Remarks');


                $rows = 4;


                foreach ($outlet_stockexpiry as $stock) {
                    $sheet6->setCellValue('A' . $rows, date('d-m-Y', strtotime($stock->date)));

                    $sheet6->setCellValue('B' . $rows, $stock->store_code);

                    $sheet6->setCellValue('C' . $rows, $stock->store_name);
                    $sheet6->setCellValue('D' . $rows, (isset($stock->outlet->outlet_city) ? $stock->outlet->outlet_city : '-'));

                    $sheet6->setCellValue('E' . $rows, $stock->first_name);

                    $sheet6->setCellValue('F' . $rows, $stock->category_name);
                    $sheet6->setCellValue('G' . $rows, $stock->product_name);

                    $sheet6->setCellValue('H' . $rows, $stock->zrep_code);
                    $sheet6->setCellValue('I' . $rows, $stock->sku);
                    $sheet6->setCellValue('J' . $rows, $stock->barcode);

                    $sheet6->setCellValue('K' . $rows, date('d-m-Y', strtotime($stock->expiry_date)));
                    $sheet6->setCellValue('L' . $rows, $stock->piece_price);
                    $sheet6->setCellValue('M' . $rows, $stock->near_expiry);
                    $sheet6->setCellValue('N' . $rows, $stock->exposure_qty);
                    $sheet6->setCellValue('O' . $rows, $stock->account);

                    $sheet6->setCellValue('P' . $rows, $stock->type);
                    $sheet6->setCellValue('Q' . $rows, $stock->remarks);

                    $rows++;
                }

                $type = 'xlsx';
                $date = \Carbon\Carbon::now()->format('Y-m-d');
                $time = \Carbon\Carbon::now()->format('His') . mt_rand(100, 10000);
                // dd($date);

                $fileName = "Monthly_Stock_Report" . $date . '-' . $time . '.' . $type;
                // $fileName = "timesheet-approval".'.'.$type;
                // dd($fileName);


                if ($type == 'xlsx') {
                    $writer = new Xlsx($spreadsheet);
                } else if ($type == 'xls') {
                    $writer = new Xls($spreadsheet);
                }

                $writer->save( "approval_files/monthly/" . $fileName);

                //\Log::info($files);


                $url = "approval_files/monthly/" . $fileName;

                \Log::info($url);


                $data = array('first_name'=>'' ,'surname' => '');
                Mail::send('timesheet.monthly',$data, function($message) use($url)
                {
                    $message->to('arun@rhapsody.ae');
                    //$message->cc('ramananv@rhapsody.ae');
                    $message->subject('Monthly Stock Report');
                    $message->from('ramananv@rhapsody.ae','RMS');
                    $message->attach($url);

//                     \Log::info($message);
                    // \Log::info('Success');
                });

                // check for failed ones
                if (Mail::failures()) {
                    // \Log::info('someting went wrong..');
                }



            }
//

        }


    }
}
