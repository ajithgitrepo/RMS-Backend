<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\competition;
use App\Brand_details;
use App\Role;
use App\User;
use App\Employee;
use App\Outlet_stockexpiry;

use App\Http\Requests;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Crypt;
use Illuminate\Support\Facades\Auth;
use App\Employee_Reporting_To;
use App\Http\Controllers\AuditController as audit_store;


class CompetitionController extends Controller
{
    


    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

   
   public function index(competition $model)
    {       
        
   // $model= DB::table('promotion')->orderby('created_at','ASC')->where('is_active',1)->get();

     $matchThese = ['is_active' => '1'];
     $model = competition::where($matchThese)->with('brand')->orderby('created_at','DESC')->get();
     
    //dd($model);
   
     return view('competition.index', ['promotion' => $model]);
    
         }
    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create(Request $request)
    {
        //dd($request->id);
        
        $brand_details  = DB::table('brand_details')->where('is_active',1)->get();

        return view('competition.create',['brand' => $brand_details]);

    }


    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)

    {
//dd($request); 
  	   
    
        $request->validate([
         'company_name' =>'required',
          'brand_id'=>'required',
           'item_name'=>'required',
            'promotion_type'=>'required',
             'promotion_description'=>'required',
              'mpr'=>'required',
               'selling_price'=>'required',
                'capture_image.*'=>'required|image|mimes:jpeg,jpg,png,doc,docx,pdf',
       
        ]);
        
         if($request->hasfile('capture_image'))
        {

            foreach($request->file('capture_image') as $file)
            {
            
               $fileName=$file->getClientOriginalName();
                $destinationPath = public_path().'/competitor/' ;
                $file->move($destinationPath,$fileName);
                $data[] = $fileName;
                $str = implode(",",$data);
            }
        }

//dd($request->company_name);
	DB::table('competitor')->insert(
	     array(
	    
	        'company_name'  => $request->company_name,
           	'brand_id' => $request->brand_id,
           	'item_name' => $request->item_name,  
           	'promotion_type' => $request->promotion_type,
           	'promotion_description' => $request->promotion_description,
           	
           	'mpr' => $request->mpr,
           	'selling_price'=>$request->selling_price,
           	'device'=> "web",
            'created_by'=>Auth::user()->emp_id,
            'capture_image'=> $str,
          	
	        'updated_at'  => date('y-m-d H:i:s'),
		    'created_at' => date('y-m-d H:i:s')

	     )
	);
   

        return redirect()->route('competition.index')->withStatus(__('promotion created successfully'));

                         

    }

   

    /**

     * Display the specified resource.

     *

     * @param  \App\Promotion $promotion

     * @return \Illuminate\Http\Response

     */

    public function show($id)

    {
	   $promotion = competition::find($id);
        return view('competition.show',['promotion' => $promotion]);
        

    }


    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\Promotion $promotion


     * @return \Illuminate\Http\Response

     */

    public function edit(Request $request)

    {
        //dd(Crypt::decrypt($request->id)); 
    	    	
        $competitor = DB::table('competitor')
            ->where('timesheet_id', Crypt::decrypt($request->id))
            ->where('competitor.is_active', 1)
            ->get();

        $brand_details  = DB::table('brand_details')->where('is_active',1)->get(); 

        $categories = DB::table('category_details')
            ->where('category_details.is_active',1)
            ->get();

       // dd($competitor);

        if ($competitor->isNotEmpty()) {
            return view('competition.edit', ['competitor' => $competitor, 'categories' => $categories]);
        } 

        if ($competitor->isEmpty()) {
            return view('competition.editor', ['categories' => $categories]);
        }    
      
       
    }

    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \App\Promotion $promotion


     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, $id )
    {

        //dd($request->all()); 

        $request->validate([
            'company_name' =>'required',
            'brand_name'=>'required',
            'category_name'=>'required',
            'item_name'=>'required',
            'promotion_type'=>'required',
            'promotion_description'=>'required',
            'mrp'=>'required',
            'selling_price'=>'required',
            // 'capture_image.*'=>'required|mimes:jpeg,jpg,png,doc,docx,pdf',
        ]);

         $competitor = DB::table('competitor')
            ->where('timesheet_id', Crypt::decrypt($id))
            ->where('competitor.is_active', 1)
            ->get();
      
        //dd($competitor);

         $str = '';   

        $get_outlet_id = DB::table('merchant_time_sheet')
            ->where('id', Crypt::decrypt($id))
            ->where('is_active', 1)
            ->get();

        //dd($get_outlet_id[0]->outlet_id);

         if ($competitor->isNotEmpty()) {
            
            if($request->hasfile('capture_image'))
            {

                foreach($request->file('capture_image') as $file)
                {
                
                    $fileName=$file->getClientOriginalName();
                    $destinationPath = public_path().'/competitor/' ;
                    $file->move($destinationPath,$fileName);
                    $data[] = $fileName;
                    $str = implode(",",$data);
                }
            }

             $result = DB::table('competitor')
                ->where('timesheet_id', Crypt::decrypt($id))
                ->update([
                    'company_name'  => $request->company_name,
                    'brand_name' => $request->brand_name,
                    'category_name' => $request->category_name,  
                    'item_name' => $request->item_name,  
                    'promotion_type' => $request->promotion_type,
                    'promotion_description' => $request->promotion_description,
                    'mrp' => $request->mrp,
                    'selling_price'=>$request->selling_price,
                    'capture_image'=> $str,
                    'updated_at'  => date('y-m-d H:i:s'),
                 	'device'=> "web",
               		'created_by' => Auth::user()->emp_id,
              ]);

             return redirect()->back()->withStatus(__('Competitor Info updated successfully..'));

         }

        if ($competitor->isEmpty()) {
            
            if($request->hasfile('capture_image'))
            {

                foreach($request->file('capture_image') as $file)
                {
                
                    $fileName=$file->getClientOriginalName();
                    $destinationPath = public_path().'/competitor/' ;
                    $file->move($destinationPath,$fileName);
                    $data[] = $fileName;
                    $str = implode(",",$data);
                }
            }

             DB::table('competitor')->insert(
             array(
                'timesheet_id'  => Crypt::decrypt($id),
                'outlet_id' => $get_outlet_id[0]->outlet_id,
                'company_name'  => $request->company_name,
                'brand_name' => $request->brand_name,
                'category_name' => $request->category_name,  
                'item_name' => $request->item_name,  
                'promotion_type' => $request->promotion_type,
                'promotion_description' => $request->promotion_description,
                'mrp' => $request->mrp,
                'selling_price'=>$request->selling_price,
                'capture_image'=> $str,
                'device'=> "web",
                'updated_at'  => date('y-m-d H:i:s'),
                'created_at' => date('y-m-d H:i:s'),
                'created_by' => Auth::user()->emp_id,

                 )
            );

             $outlet = DB::table('merchant_time_sheet')
            ->select('merchant_time_sheet.*','store_details.store_name','store_details.store_code','store_details.address','outlet.outlet_state')
            ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
            ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
            ->where('merchant_time_sheet.id', Crypt::decrypt($id))
            ->where('merchant_time_sheet.is_active', 1)
            ->get();

             $user = Auth::user()->emp_id;

            $notify = new NotificationController();
             $ReportTo = "";
             $ReportTo = Employee_Reporting_To::where('employee_id', '=', $user)->first();
             if( $ReportTo != "")
             $ReportToID = $ReportTo->reporting_to_emp_id; 
             $title = "Merchandiser update competitor";
             $user_type = "merchandiser";
             $created_to = $ReportToID;
             $add_notify =  $notify->store($title, $user_type, $ReportToID);

            if($outlet->isNotEmpty())
            {
                $outlet_name = $outlet[0]->store_name.'['.$outlet[0]->store_code.'],'.$outlet[0]->address.','.$outlet[0]->outlet_state; 

                $audit = new audit_store();
                $description = ' updated competitor info in '.$outlet_name;
                $add_audit =  $audit->store($description,'compititor'); 
            }

            return redirect()->back()->withStatus(__('Competitor Info updated successfully..'));

        }

           
       
    }

  

    /**

     * Remove the specified resource from storage.

     *

     * @param  \App\Promotion $promotion

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

      // $delete = DB::table('outlet')->where('outlet_id', $id)->delete();

       $delete = DB::table('competitor')->where('id', $id)->update(['is_active' => '0']);
             
  	    return redirect()->route('competition.index')->withStatus(__('promotion deleted successfully'));              
                         
    }   
    public function competitor_visibility(Request $request)
    {  

      $request->validate([
            'company_name' =>'required',
            'brand_name'=>'required',
            'visibility_type'=>'required',
            'promotion_image.*'=>'required|mimes:jpeg,jpg,png',
        ]);

        $competitor = DB::table('competitor')
            ->where('timesheet_id', Crypt::decrypt($request->id))
            ->where('competitor.is_active', 1)
            ->get();
      
        //dd($competitor);

        $get_outlet_id = DB::table('merchant_time_sheet')
            ->where('id', Crypt::decrypt($request->id))
            ->where('is_active', 1)
            ->get();

        //dd($get_outlet_id);

         $str = '';   

         if ($competitor->isNotEmpty()) {
            
            if($request->hasfile('promotion_image'))
            {

                foreach($request->file('promotion_image') as $file)
                {
                
                    $fileName=$file->getClientOriginalName();
                    $destinationPath = public_path().'/competitor/visibility' ;
                    $file->move($destinationPath,$fileName);
                    $data[] = $fileName;
                    $str = implode(",",$data);
                }
            }

             $result = DB::table('competitor')
                ->where('timesheet_id', Crypt::decrypt($request->id))
                ->update([
                    'company_name'  => $request->company_name,
                    'brand_name' => $request->brand_name,
                    'visibility_type' => $request->visibility_type,  
                    'visibility_image' => $str,
                    'updated_at'  => date('y-m-d H:i:s')
              ]);

             return redirect()->back()->withStatus(__('Competitor visibility updated successfully..'));

         }

        if ($competitor->isEmpty()) {
            
            if($request->hasfile('promotion_image'))
            {

                foreach($request->file('promotion_image') as $file)
                {
                
                    $fileName=$file->getClientOriginalName();
                    $destinationPath = public_path().'/competitor/visibility' ;
                    $file->move($destinationPath,$fileName);
                    $data[] = $fileName;
                    $str = implode(",",$data);
                }
            }

             DB::table('competitor')->insert(
             array(
                'timesheet_id'  => Crypt::decrypt($request->id),
                'outlet_id' => $get_outlet_id[0]->outlet_id,
                'company_name'  => $request->company_name,
                'brand_name' => $request->brand_name,
                'visibility_type' => $request->visibility_type,  
                'visibility_image' => $str,
                'updated_at'  => date('y-m-d H:i:s'),
                'created_at' => date('y-m-d H:i:s'),
                'created_by' => Auth::user()->emp_id

                 )
            );

            return redirect()->back()->withStatus(__('Competitor visibility updated successfully..'));

        }

      
    }

 
   } 

