<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Outlet;
use App\Attendance;
use App\Leave;
use App\Role;
use App\User;
use App\Employee;

use App\Http\Requests;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Imports\OutletImport;
use Maatwebsite\Excel\Facades\Excel;

use Auth;
use App\Http\Controllers\AuditController as audit_store;


class OutletController extends Controller
{
    
   public function index(Outlet $model)
    {       
        
     //dd(Auth::user()->role->name);

     $matchThese = ['is_active' => '1','created_by' => Auth::user()->emp_id];
     $model = Outlet::where($matchThese)->with('store','outlet_product')->orderby('created_at','DESC')->paginate(10);
     //dd($model);
  
     $store_details  = DB::table('store_details')
     ->where('is_active',1)
     ->where('created_by',Auth::user()->emp_id)
     ->get();
     
     return view('outlet.index', ['outlet' => $model,'store'=> $store_details]);
    
    }
    


    public function create()

    {
        //$outlet= DB::table('outlet')->orderby('created_at','DESC')->where('is_active',1)->get();
        
        $store_details  = DB::table('store_details')
        ->where('created_by',Auth::user()->emp_id)
        ->where('is_active',1)->get();

        $products  = DB::table('product_details')->where('is_active',1)->get();

        return view('outlet.create',['store' => $store_details, 'product' => $products]);

    }

    public function import_csv()
    {
        //$outlet= DB::table('outlet')->orderby('created_at','DESC')->where('is_active',1)->get();
        
        //$store_details  = DB::table('store_details')->where('is_active',1)->get();

        return view('outlet.import');

    }



    public function store(Request $request)

    {
        //dd($request->all());
    
        $request->validate([
            'outlet_name' =>'required',
            //'product' =>'required',
            'outlet_lat'=>'required|regex:/^-?\d{1,2}\.\d{5,}$/',
            'outlet_long'=>'required|regex:/^-?\d{1,2}\.\d{5,}$/',
            'outlet_area'=>'required',
            'outlet_city'=>'required',
            'outlet_state'=>'required',
            'outlet_country'=>'required',
       
        ]);


          DB::table('outlet')->insert(
               array(
              
                    'outlet_name'  => $request->outlet_name,
                    //'product_id'  => $request->product,
                    'outlet_lat' => $request->outlet_lat,
                    'outlet_long' => $request->outlet_long,  
                    'outlet_area' => $request->outlet_area,
                    'outlet_city' => $request->outlet_city,
                    'outlet_state' => $request->outlet_state,
                    'outlet_country' => $request->outlet_country,
                    'created_by'  =>  Auth::user()->emp_id,
                    'updated_at'  => date('y-m-d H:i:s'),
                    'created_at' => date('y-m-d H:i:s')

               )
          );

            $audit = new audit_store();
            $description = ' added a outlet';
            $add_audit =  $audit->store($description,'outlet'); 
   

        return redirect()->route('outlet.index')->withStatus(__('outlet created successfully'));

                         
    }

   

    public function show($id)

    {
  $outlet = Outlet::find($id);
        return view('outlet.show',['outlet' => $outlet]);
        

    }



    public function edit($id)

    {
            
        $out = DB::table('outlet')->where('outlet_id', $id)->get();
               
               
       $store_details = DB::table('store_details')->where('is_active',1)->get();

       $products  = DB::table('product_details')->where('is_active',1)->get();
             
        return view('outlet.edit',['outlet' => $out, 'store' => $store_details, 'product' => $products ]);
        
       
    }

  

    public function update(Request $request, $id )

    {

      $request->validate([
            'outlet_name' =>'required',
            //'product' =>'required',
            'outlet_lat'=>'required|regex:/^-?\d{1,2}\.\d{5,}$/',
            'outlet_long'=>'required|regex:/^-?\d{1,2}\.\d{5,}$/',
            'outlet_area'=>'required',
            'outlet_city'=>'required',
            'outlet_state'=>'required',
            'outlet_country'=>'required',
       
        ]);

 //dd($request);
    
       $affected = DB::table('outlet')
              ->where('outlet_id', $id)
              ->update([
              'outlet_name' => $request->outlet_name,
              //'product_id'  => $request->product,
              'outlet_lat' => $request->outlet_lat,
              'outlet_long' => $request->outlet_long,
              'outlet_area' => $request->outlet_area,
              'outlet_city' => $request->outlet_city,
              'outlet_state' => $request->outlet_state,
              'outlet_country' => $request->outlet_country,
             
              ]);

            if($affected)
            {
                $audit = new audit_store();
                $description = ' updated a outlet';
                $add_audit =  $audit->store($description,'outlet'); 
            }

        return redirect()->route('outlet.index')->withStatus(__('outlet updated successfully'));


    }

  

    public function destroy($id)

    {

       // $delete = DB::table('outlet')->where('outlet_id', $id)->update(['is_active'=>'0']);
      
      //  return redirect()->route('outlet.index')->withStatus(__('outlet deleted successfully'));

      // $delete = DB::table('outlet')->where('outlet_id', $id)->delete();

        $delete = DB::table('outlet')->where('outlet_id', $id)->update(['is_active' => '0']);

         if($delete)
            {
                $audit = new audit_store();
                $description = ' deleted a outlet';
                $add_audit =  $audit->store($description,'outlet'); 
            }
             
        return redirect()->route('outlet.index')->withStatus(__('outlet deleted successfully'));              
                         
    }  


     public function import(Request $request)
    {

         $request->validate([
            'outlet_import' => 'required|mimes:csv,xlsx,xls,txt'
        ]);

         // dd($request->outlet_import);

       if($request->hasfile('outlet_import'))
        { 
             //$customerArr = $this->csvToArray($request->outlet_import);

           $customerArr = Excel::toArray(new OutletImport,request()->file('outlet_import'));

        }

        // dd($customerArr); 

         $items = array();    

        for ($i = 0; $i < count($customerArr[0]); $i ++)
        {

           // dd($customerArr[0][$i]['outletname']);

            $store_arr = explode("-",$customerArr[0][$i]['outletname']);

            //dd($store_arr[0]);

            $check = DB::table('store_details')
                ->where('store_code', $store_arr[0])
                ->where('is_active', 1)
                ->get();

            // dd($check);

            if($check->isEmpty()){

                if (isset($store_arr[2])) { 

                      $insert_id = DB::table('store_details')->insertGetId(
                        array(
                            'store_code' =>$store_arr[0],  
                            'store_name'=>$store_arr[1].','.$store_arr[2],
                            'contact_number'=>'',
                            'address'=>$customerArr[0][$i]['area'].','.$customerArr[0][$i]['emirates'],
                            'created_by'=> Auth::user()->emp_id,
                            'updated_at'  => date('y-m-d H:i:s'),
                            'created_at' => date('y-m-d H:i:s')
                           
                        )
                    );

                } 

                else{
                      $insert_id = DB::table('store_details')->insertGetId(
                        array(
                            'store_code' =>$store_arr[0],  
                            'store_name'=>$store_arr[1],
                            'contact_number'=>'',
                            'address'=>$customerArr[0][$i]['area'].','.$customerArr[0][$i]['emirates'],
                            'created_by'=> Auth::user()->emp_id,
                            'updated_at'  => date('y-m-d H:i:s'),
                            'created_at' => date('y-m-d H:i:s')
                           
                        )
                    );

                }


                $get_outlet =  DB::table('outlet')
                    ->where('outlet_name', $insert_id )
                    ->where('is_active', 1)
                    ->get();
                
                // dd($get_outlet);

                if($get_outlet->isEmpty()) 
                {

                       $values = array(
                            'outlet_name' => $insert_id,
                            'outlet_lat' => $customerArr[0][$i]['latitude'],
                            'outlet_long' => $customerArr[0][$i]['longitude'],
                            'outlet_area' => $customerArr[0][$i]['area'],
                            'outlet_city' => $customerArr[0][$i]['emirates'],
                            'outlet_state' => $customerArr[0][$i]['emirates'],
                            'outlet_country' => $customerArr[0][$i]['emirates'],
                            'account'=>$customerArr[0][$i]['account'],
                            'created_by'=> Auth::user()->emp_id,
                            'updated_at'  => date('y-m-d H:i:s'),
                            'created_at' => date('y-m-d H:i:s')
                          );
                       // dd($values);
                        
                   
                    $insert_outlet = DB::table('outlet')->insert($values);
                    // dd($insert_outlet);
                }
            }    

            if($check->isNotEmpty()) 
            { 

                 if (isset($store_arr[2])) { 

                     $update_store = array(
                        'store_code' =>$store_arr[0],
                        'store_name'=>$store_arr[1].','.$store_arr[2],
                        'contact_number'=>'',
                        'address'=>$customerArr[0][$i]['area'].','.$customerArr[0][$i]['emirates'],
                        'updated_at'  => date('y-m-d H:i:s')
                      );

                     
                } 

                else{
                     $update_store = array(
                        'store_code' =>$store_arr[0],
                        'store_name'=>$store_arr[1],
                        'contact_number'=>'',
                        'address'=>$customerArr[0][$i]['area'].','.$customerArr[0][$i]['emirates'],
                        'updated_at'  => date('y-m-d H:i:s')
                      );

                }

                 $affected_store = DB::table('store_details')
                      ->where('store_code', $store_arr[0])
                      ->update($update_store);
				
                $check_exist = DB::table('store_details')
                ->where('store_code', $store_arr[0])
                ->where('is_active', 1)
                ->get();

                // dd($check_exist[0]->id);

                $get_outlet_update =  DB::table('outlet')
                    ->where('outlet_name', $check_exist[0]->id )
                    ->where('is_active', 1)
                    ->get();

               // dd($get_outlet_update);

                if($get_outlet_update->isNotEmpty()) 
                { 
                     $update_outlet = array(
                        'outlet_lat' => $customerArr[0][$i]['latitude'],
                        'outlet_long' => $customerArr[0][$i]['longitude'],
                        'outlet_area' => $customerArr[0][$i]['area'],
                        'outlet_city' => $customerArr[0][$i]['emirates'],
                        'outlet_state' => $customerArr[0][$i]['emirates'],
                        'account'=>$customerArr[0][$i]['account'],

                        'outlet_country' => 'UAE',
                        'created_by'=> Auth::user()->emp_id,
                        'updated_at'  => date('y-m-d H:i:s')
                      );

                     $affected = DB::table('outlet')
                      ->where('outlet_name', $get_outlet_update[0]->outlet_name)
                      ->update($update_outlet);
                }

                if($get_outlet_update->isEmpty()) 
                { 
                        $values = array(
                            'outlet_name' => $check_exist[0]->id ,
                            'outlet_lat' => $customerArr[0][$i]['latitude'],
                            'outlet_long' => $customerArr[0][$i]['longitude'],
                            'outlet_area' => $customerArr[0][$i]['area'],
                            'outlet_city' => $customerArr[0][$i]['emirates'],
                            'outlet_state' => $customerArr[0][$i]['emirates'],
                            'outlet_country' => 'UAE',
                            'account'=>$customerArr[0][$i]['account'],
                            'created_by'=> Auth::user()->emp_id,
                            'updated_at'  => date('y-m-d H:i:s'),
                            'created_at' => date('y-m-d H:i:s')
                          );
                        // dd($values);
                   
                    $insert_outlet = DB::table('outlet')->insert($values);
                    // dd($insert_outlet);
                }

            }


        }

            $audit = new audit_store();
            $description = ' imported a outlets';
            $add_audit =  $audit->store($description,'outlet'); 

            return redirect()->route('outlet.create')->withStatus(__('Outlet imported successfully..'));
      
        
    }


    function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
        //dd($data);
    }


    public function filter_outlet(Request $request)
    {
        if(Auth::user()->role->name =="Top Management" || Auth::user()->role->name =="Admin")
        {

            $store_details  = DB::table('store_details')
                 ->where('is_active',1)
                 ->get();

            $matchThese = ['is_active' => '1'];

            $model = Outlet::where($matchThese)->with('store','product','outlet_product');
         
        }  

        if(Auth::user()->role->name =="Field Manager")
        {
            $store_details  = DB::table('store_details')
               ->where('is_active',1)
               //->where('created_by',Auth::user()->emp_id)
               ->get();

            $matchThese = ['is_active' => '1'];

            $model = Outlet::where($matchThese)->with('store','product','outlet_product');
         
        } 

        if(Auth::user()->role->name =="Client")
        {
            $store_details  = DB::table('store_details')
               ->where('is_active',1)
               ->where('created_by',Auth::user()->emp_id)
               ->get();

            $matchThese = ['is_active' => '1','created_by' => Auth::user()->emp_id];

            $model = Outlet::where($matchThese)->with('store','product','outlet_product');
         
        }  
         

        if(!empty($request->outlet_name))
        {
               
            $model->where('outlet.outlet_name',$request->outlet_name);
        }
               
          
        if(!empty($request->outlet_area))
        {

            $model->where('outlet.outlet_area',$request->outlet_area);
       
        }
            
        if(!empty($request->outlet_city))
        {

            $model->where('outlet.outlet_city',$request->outlet_city);
       
        }
        
        if(!empty($request->outlet_state))
        {

            $model->where('outlet.outlet_state',$request->outlet_state);
       
        }
             
         $query = $model->paginate(10);
         $query->appends(['outlet_name' => $request->outlet_name,'outlet_area' => $request->outlet_area,'outlet_city' => $request->outlet_city, 'outlet_state' => $request->outlet_state, 'outlet_country' => $request->outlet_country]);
       
          
    //dd($query);

      
     
       return view('outlet.index', ['outlet' => $query,'store'=> $store_details]);
     
    }
 
   } 

