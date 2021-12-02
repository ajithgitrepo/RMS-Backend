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
use App\cde_reporting;
use App\merchant_timesheet;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use Illuminate\Support\Facades\Mail;


class SendApprovalCron extends Command
{
   
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';
    
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
     * @return mixed
     */
    public function handle(cde_reporting $modeL)
    {
     
        /*
           Write your database logic we bellow:
           Item::create(['name'=>'hello new']);
        */

      
        $cde_array = array();
        $mer_array = array();

        $matchThese = ['cde_reporting.is_active' => '1', 'employee.is_active' => '1'];
        $cdes = cde_reporting::where($matchThese)->with('cde_reporting')
         ->leftJoin('employee', 'employee.employee_id', '=', 'cde_reporting.merchandiser_id')
        ->get();

        //dd($cdes);
        //\Log::info($cdes);

        foreach($cdes as $cde)
        {

            if (!in_array($cde->cde_id, $cde_array)) {

                $cde_array[] = $cde->cde_id;
            }
            
           
            if (array_key_exists($cde->cde_id,$mer_array)){

                $mer_array[$cde->cde_id][] = $cde->merchandiser_id;
               
            }

            if (!array_key_exists($cde->cde_id,$mer_array)){

                $mer_array[$cde->cde_id][] = $cde->merchandiser_id;
            }


        }

        // dd($mer_array);
          \Log::info($mer_array);


        // \Log::info($cde_array);

        foreach($cde_array as $key => $cde)
        {
        	//\Log::info($mer_array);
              // if($cde =="Emp9318" || $cde =="Emp2693" || $cde =="Emp7681" || $cde =="Emp9893" || $cde =="Emp9371" || $cde =="Emp9549" || $cde =="Emp3374" || $cde =="Emp8650" )
              // {

                $merchant_ids = $mer_array[$cde];
                //\Log::info($merchant_ids);

                $matchThese = ['is_active' => '1', 'cde_id' => $cde];
                $basic_details = cde_reporting::where($matchThese)->with('cde_reporting')->groupBy('cde_id')->get();

                $cde_id = $basic_details[0]->cde_id;
                $cde_email = $basic_details[0]->cde_reporting->email;
                $cde_first_name = $basic_details[0]->cde_reporting->first_name;
                $cde_surname = $basic_details[0]->cde_reporting->surname;
                $cde_mobile_no = $basic_details[0]->cde_reporting->mobile_number;
                
                //\Log::info($cde_first_name);

                $count = count($merchant_ids)-1;
                //\Log::info($count);

                $files = array();
                $previous_date = date('Y-m-d',strtotime("-1 days"));

                $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load("templates/template.xls");

                for($loop = 0; $loop<=$count; $loop++)
                {
                    \Log::info($merchant_ids[$loop]);
                    
                	$spreadsheet->createSheet();
                
                    $matchThese = ['merchant_time_sheet.is_active' => '1', 'employee.is_active'=> '1'];
                    $total_timesheets = merchant_timesheet::with(['outlet','employee','employee_field'])
                    ->select('merchant_time_sheet.*','store_details.store_name','store_details.store_code','store_details.address')
                    ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
                    ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
                    ->leftJoin('employee', 'employee.employee_id', '=', 'merchant_time_sheet.employee_id')
                    ->where($matchThese)  
                    ->where('merchant_time_sheet.employee_id', $merchant_ids[$loop])
                    ->whereDate('date', '=', $previous_date) 
                    //->whereMonth('date', date('m'))
                    ->orderBy('date')
                    ->orderBy('checkin_time')
                    ->get();
                
                	//\Log::info($total_timesheets);

                    if($total_timesheets->isNotEmpty())
                    {

                        //\Log::info($total_timesheets[0]->store_name);
                    
                         if($loop <=0){
                         
                            $sheet = $spreadsheet->getActiveSheet()->setTitle($total_timesheets[0]->employee->first_name);

                        }

                        
                        if($loop >=1){

                            
                            $spreadsheet->setActiveSheetIndex($loop);
                            
                            $sheet = $spreadsheet->getActiveSheet()->setTitle($total_timesheets[0]->employee->first_name);
                        
                            $sheet->getColumnDimension('A')->setWidth(15);
                            $sheet->getColumnDimension('B')->setWidth(15);
                            $sheet->getColumnDimension('C')->setWidth(15);
                            $sheet->getColumnDimension('D')->setWidth(70);
                            $sheet->getColumnDimension('E')->setWidth(15);
                            $sheet->getColumnDimension('F')->setWidth(15);
                            $sheet->getColumnDimension('G')->setWidth(15);
                            $sheet->getColumnDimension('H')->setWidth(15);
                            $sheet->getColumnDimension('I')->setWidth(15);

                            $sheet->setCellValue('D1', 'Merchandiser Time Sheet');
                            $sheet->setCellValue('B2', 'Employee Code');
                            $sheet->setCellValue('B3', 'Name');
                            $sheet->setCellValue('E2', 'Mobile No');
                            $sheet->setCellValue('E3', 'Month');
                            $sheet->setCellValue('B4', 'Salesman');
                            $sheet->setCellValue('E4', 'Mobile No');

                            $sheet->setCellValue('B6', 'Date');
                            $sheet->setCellValue('C6', 'Store Code');
                            $sheet->setCellValue('D6', 'Location');
                            $sheet->setCellValue('E6', 'Time in');
                            $sheet->setCellValue('F6', 'Time out');
                            $sheet->setCellValue('G6', 'Total Working Time');
                            $sheet->setCellValue('H6', 'Type');
                            $sheet->setCellValue('I6', 'Verified by');


                            $spreadsheet
                            ->getActiveSheet()
                            ->getStyle('B6:I6')
                            ->getFont()->setBold( true );


                        }

                        
                        $sheet->setCellValue('C2', $total_timesheets[0]->employee->employee_id);
                        $sheet->setCellValue('F2', $total_timesheets[0]->employee->mobile_number);

                        $sheet->setCellValue('C3', $total_timesheets[0]->employee->first_name.' '.$total_timesheets[0]->employee->surname);
                        $sheet->setCellValue('F3', \Carbon\Carbon::now()->format('F') );

                        $sheet->setCellValue('C4', $cde_first_name);
                        $sheet->setCellValue('F4', $cde_mobile_no);

                        $rows = 7;
                        $i = 1;

                        $new_array = array();

                        foreach($total_timesheets as $timesheets){

                            //if(isset($timesheets->checkin_time)){

                                $sheet->setCellValue('B' . $rows, date('d - m - Y',strtotime( $timesheets->date)) );
                                $sheet->setCellValue('C' . $rows, $timesheets->store_code );
                                $sheet->setCellValue('D' . $rows, $timesheets->store_name .','. (isset($timesheets->outlet->outlet_area) ? $timesheets->outlet->outlet_area : ' ') .','. (isset($timesheets->outlet->outlet_city) ? $timesheets->outlet->outlet_city : ' ') .','.(isset($timesheets->outlet->outlet_state) ? $timesheets->outlet->outlet_state : ' ') .','.(isset($timesheets->outlet->outlet_country) ? $timesheets->outlet->outlet_country : ' ') );
                                if(isset($timesheets->checkin_time))
                                    $sheet->setCellValue('E' . $rows, $timesheets->checkin_time);
                                else
                                    $sheet->setCellValue('E' . $rows, '-');

                                if(isset($timesheets->checkout_time))
                                    $sheet->setCellValue('F' . $rows, $timesheets->checkout_time);
                                else
                                    $sheet->setCellValue('F' . $rows, '-');

                               
                                if(isset($timesheets->checkin_time) && isset($timesheets->checkout_time) )
                                {
                                    $start  = \Carbon\Carbon::parse($timesheets->checkin_time);
                                    $end    = \Carbon\Carbon::parse($timesheets->checkout_time);

                                    $new_array[] = $start->diff($end)->format('%H:%I');

                                    $sheet->setCellValue('G' . $rows, $start->diff($end)->format('%H:%I') );
                                }
                                else{
                                    $sheet->setCellValue('G' . $rows, '-' );
                                }

                                if($timesheets->is_defined == 1)
                                {

                                    $sheet->setCellValue('H' . $rows, 'Scheduled' );
                                }
                                else{
                                    $sheet->setCellValue('H' . $rows, 'UnScheduled' );
                                }

                                $sheet->setCellValue('I' . $rows,  $timesheets->employee_field->first_name.' '.$timesheets->employee_field->surname);


                                $spreadsheet
                                    ->getActiveSheet()
                                    ->getStyle('B'.$rows.':I'.$rows)
                                    ->getBorders()
                                    ->getAllBorders()
                                    ->setBorderStyle(Border::BORDER_THIN)
                                    ->setColor(new Color('000'));

                                $affected = DB::table('merchant_time_sheet')
                                  ->where('id', $timesheets->id)
                                  ->update([

                                    'cde_approval'   => '1',
                                    'updated_at'      => date('y-m-d H:i:s'),
                                               
                                ]);



                                $rows++;
                                $i++;

                            //}

                        }

                        //\Log::info($new_array);

                        $row_count = $rows+1;

                        $sheet->setCellValue('E'.$row_count, 'Total Working Time');
                        $minutes = 0;
                        foreach ($new_array as $time) {
                            list($hour, $minute) = explode(':', $time);
                            $minutes += $hour * 60;
                            $minutes += $minute;
                        }

                        $hours = floor($minutes / 60);
                        $minutes -= $hours * 60;

                        $sheet->setCellValue('G'.$row_count, $hours.':'.$minutes.' Hrs');

                        $sheet->mergeCells('E'.$row_count.':F'.$row_count);

                        $spreadsheet
                            ->getActiveSheet()
                            ->getStyle('E'.$row_count.':F'.$row_count)
                            ->getFont()->setBold( true );


                        $spreadsheet
                            ->getActiveSheet()
                            ->getStyle('B2:I2')
                            ->getBorders()
                            ->getAllBorders()
                            ->setBorderStyle(Border::BORDER_THIN)
                            ->setColor(new Color('000'));

                        $sheet->mergeCells('F2:I2');

                        $spreadsheet
                            ->getActiveSheet()
                            ->getStyle('B3:I3')
                            ->getBorders()
                            ->getAllBorders()
                            ->setBorderStyle(Border::BORDER_THIN)
                            ->setColor(new Color('000'));

                        $sheet->mergeCells('F3:I3');



                        $row_count = $row_count+2;

                        for($j=0; $j<=4; $j++)
                        {
                            if($j==0)
                            {
                                $sheet->setCellValue('C'.$row_count, 'Checked by Operation in charge');
                                $sheet->setCellValue('D'.$row_count, 'Approved By');
                                $sheet->mergeCells('D'.$row_count.':I'.$row_count);
                            }

                            if($j==1)
                            {
                                $sheet->setCellValue('B'.$row_count, 'Name');
                                $sheet->setCellValue('C'.$row_count, '');
                                $sheet->setCellValue('D'.$row_count, '');
                                $sheet->mergeCells('D'.$row_count.':I'.$row_count);
                            }

                            if($j==2)
                            {
                                $sheet->setCellValue('B'.$row_count, 'Designation');
                                $sheet->setCellValue('C'.$row_count, '');
                                $sheet->setCellValue('D'.$row_count, '');
                                $sheet->mergeCells('D'.$row_count.':I'.$row_count);
                            }

                            if($j==3)
                            {
                                $sheet->setCellValue('B'.$row_count, 'Date');
                                $sheet->setCellValue('C'.$row_count, '');
                                $sheet->setCellValue('D'.$row_count, '');
                                $sheet->mergeCells('D'.$row_count.':I'.$row_count);
                            }

                            if($j==4)
                            {
                                $sheet->setCellValue('B'.$row_count, 'Signature');
                                $sheet->setCellValue('C'.$row_count, '');
                                $sheet->setCellValue('D'.$row_count, '');
                                $sheet->mergeCells('D'.$row_count.':I'.$row_count);
                            }

                            $spreadsheet
                                ->getActiveSheet()
                                ->getStyle('B'.$row_count.':I'.$row_count)
                                ->getBorders()
                                ->getAllBorders()
                                ->setBorderStyle(Border::BORDER_THIN)
                                ->setColor(new Color('000'));
                            

                        $row_count++;

                       
                        }

                        
                        
                        if($loop == $count){

                            //\Log::info($files);

                            $data = array('first_name'=> $cde_first_name, 'surname' => $cde_surname);

                            $type = 'xlsx';
                            $date = \Carbon\Carbon::now()->format('Y-m-d');
                            $time = \Carbon\Carbon::now()->format('His').mt_rand(100, 10000);
                           // dd($date);

                            $fileName = "timesheet-approval-".$cde_first_name.'-'.$total_timesheets[0]->employee_field->first_name.'-'.$date.'-'.$time.'.'.$type;
                           // $fileName = "timesheet-approval".'.'.$type;
                           // dd($fileName);

                            if($type == 'xlsx') {
                                $writer = new Xlsx($spreadsheet);
                            } 
                            else if($type == 'xls') {
                                $writer = new Xls($spreadsheet);
                            }

                            $writer->save("approval_files/".$fileName);
                            
                            $url ="approval_files/".$fileName;
                        
                         //\Log::info($url);

                            array_push($files,$url);

                            $field_manager_email = $total_timesheets[0]->employee_field->email;

                            $data = array('first_name'=> $cde_first_name, 'surname' => $cde_surname);

                            //     Mail::send('timesheet.mail', $data, function($message) use($cde_email, $files, $field_manager_email, $url) {
                            //          $message->to('ajithrockers007@gmail.com');
                            //          $message->subject('Timesheet Approval');
                            //          $message->from('ramananv@rhapsody.ae','RMS');
                            //          //foreach ($files as $file){
                            //          $message->attach($url);
                            //         // }
                            // });

                        Mail::send('timesheet.mail', $data, function($message) use($cde_email, $files, $field_manager_email) {
                             $message->to($cde_email);
                             $message->cc('ramananv@rhapsody.ae',$field_manager_email);
                             $message->subject('Timesheet Approval');
                             $message->from('ramananv@rhapsody.ae','RMS');
                             foreach ($files as $file){
                                 $message->attach($file);
                             }
                         });

                         // check for failed ones
                         if (Mail::failures()) {
                              \Log::info('someting went wrong..');
                        }

                            \Log::info($fileName.'-sended');

                        }


                    }
                
                	else{
                    	\Log::info('Timesheet does not exist this merchandiser - '.$merchant_ids[$loop]);
                    }

                }

            //}

        }


        $this->info('Demo:Cron Cummand Run successfully!');


    }
}