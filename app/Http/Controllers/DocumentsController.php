<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\Employee;
use App\Document;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DocumentsController extends Controller
{
     public function index(Document $model)
    {

        $matchThese = ['is_active' => '1'];

        $results = Document::with('employees')->where($matchThese)->get();
        
        //$result = $model->with('employees')->get();
        //dd($results);

       //$results = Document::with('employees')->get();

      // dd($results);

        return view('employee.documents.index', ['documents' => $results]);
    }

    public function create(Request $request)
    {
        $id = $request->id;
       $matchThese = ['employee_id' => $id];
        $results = Employee::where($matchThese)->get();
       // dd( $results);
        return view('employee.documents.create', ['documents' => $results]);
        // return "Document Page";
     }

    public function store(Request $request, Employee $model)
    {
     //dd($request->employee_id);
     
        $validatedData = $request->validate([
            'employee_id' => 'required|unique:documents',
            'passport_photo' => 'required',
            
            'passport_expiry.*' => 'required|date',
            'passport_copy.*' => 'required|mimes:jpeg,jpg,png,doc,docx,pdf',
                
            'visa_copy.*' => 'required|mimes:jpeg,jpg,png,doc,docx,pdf',
                        
            //'dl_copy.*' => 'required|mimes:jpeg,jpg,png,doc,docx,pdf',
            //'dl_expiry.*' => 'required|date',
            
            
            'edu_certificate.*' => 'required|mimes:jpeg,jpg,png,doc,docx,pdf',
                
            'emirate_id' => 'required',
            'emi_certificate.*' => 'required|mimes:jpeg,jpg,png,doc,docx,pdf',
            
            'lab_expiry' => 'required|date',
            'lab_certificate.*' => 'required|mimes:jpeg,jpg,png,doc,docx,pdf',
            
            'exp_certificate.*' => 'required|mimes:jpeg,jpg,png,doc,docx,pdf',
        ]);

        if($request->hasfile('passport_photo'))
        {
           $passport_photo = $request->passport_photo;

           $destinationPath = 'passport_photo/';
        
           $passport_photo_file_filename = $passport_photo->getClientOriginalName();

           $passport_photo->move($destinationPath, $passport_photo_file_filename);
 
       }

         if($request->hasfile('passport_copy'))
         {
            
               $passport_copy = $request->file('passport_copy');

                foreach ($passport_copy as $passport_copy_file) {
                    //$name = time().'-'.$passport_photo->extension();
                    $passport_copy_file_filename = $passport_copy_file->getClientOriginalName();
                    $passport_copy_file->move('passport_copy/', $passport_copy_file_filename);
                    $passport_copy_data[] = $passport_copy_file_filename; 
                }

               // dd($passport_copy_data);

         }

         if($request->hasfile('visa_copy'))
         {
            
                $visa_copy = $request->file('visa_copy');

                foreach ($visa_copy as $visa_copy_file) {
                    //$name = time().'-'.$passport_photo->extension();
                    $visa_copy_file_filename = $visa_copy_file->getClientOriginalName();
                    $visa_copy_file->move('visa_copy/', $visa_copy_file_filename);
                    $visa_copy_data[] = $visa_copy_file_filename; 
                }

               // dd($visa_copy_data);

         }
         
         if($request->hasfile('dl_copy'))
         {
            
                $dl_copy = $request->file('dl_copy');

                foreach ($dl_copy as $dl_copy_file) {
                    //$name = time().'-'.$passport_photo->extension();
                    $dl_copy_file_filename = $dl_copy_file->getClientOriginalName();
                    $dl_copy_file->move('dl_copy/', $dl_copy_file_filename);
                    $dl_copy_data[] = $dl_copy_file_filename; 
                }

                //dd($dl_copy_data); emirate_copy

         }
         else
         $dl_copy_data = ""; 

         if($request->hasfile('edu_certificate'))
         {
            
                $files = $request->file('edu_certificate');

                foreach ($files as $file) {
                    //$name = time().'-'.$passport_photo->extension();
                    $filename = $file->getClientOriginalName();
                    $file->move('education_certificate/', $filename);
                    $edu_certificate_data[] = $filename; 
                }

                //dd($edu_certificate_data);
            }

            if($request->hasfile('emi_certificate'))
            {
                 $files = $request->file('emi_certificate');
                 foreach ($files as $file) {
                       //$name = time().'-'.$passport_photo->extension();
                       $filename = $file->getClientOriginalName();
                       $file->move('emirates_certificate/', $filename);
                       $emi_certificate_data[] = $filename;    
                   }   
                //dd($edu_certificate_data);
             }
             if($request->hasfile('lab_certificate'))
             {
                  $files = $request->file('lab_certificate');
                  foreach ($files as $file) {
                        //$name = time().'-'.$passport_photo->extension();
                        $filename = $file->getClientOriginalName();
                        $file->move('labour_certificate/', $filename);
                        $lab_card_data[] = $filename;    
                    }   
                 //dd($edu_certificate_data);
              }

              
         if($request->hasfile('exp_certificate'))
         {
            
                $files = $request->file('exp_certificate');
                
                foreach ($files as $file) {
                    //$name = time().'-'.$passport_photo->extension();
                    $filename = $file->getClientOriginalName();
                    $file->move('exp_certificate/', $filename);
                    $exp_certificate_data[] = $filename; 
                }

               // dd($exp_certificate_data); emirate_copy

         }
         else
         $exp_certificate_data = "";

        $dl_expiry = $request->dl_expiry;
        $lab_expiry = $request->lab_expiry;
      //  dd($lab_expiry);
        $new_dl_expiry = date("Y-m-d", strtotime($dl_expiry));   
        if($new_dl_expiry == "1970-01-01")
        $new_dl_expiry = "";
        
        $new_labour_card_date = date("Y-m-d", strtotime($lab_expiry));

        $passport_expiry = $request->passport_expiry;
        $new_passport_expiry = date("Y-m-d", strtotime($passport_expiry)); 

        $passport_data = implode(',', array_values($passport_copy_data));
        $visa_data = implode(',', array_values($visa_copy_data));
       // dd($dl_copy_data);
        if($dl_copy_data !== "")
        $dl_data = implode(',', array_values($dl_copy_data));
        else
        $dl_data = "";
        
        $education_data = implode(',', array_values($edu_certificate_data));
       
        if($exp_certificate_data !== "")
        $exp_cer_data = implode(',', array_values($exp_certificate_data));
        else
        $exp_cer_data = "";
        $emi_certificate = implode(',', array_values($emi_certificate_data));
        $lab_data = implode(',', array_values($lab_card_data));
        $emirate_id = $request->emirate_id;
        //dd($new_data);

        $values = array(
            'employee_id' => $request->employee_id,
            'passport_photo' => $passport_photo_file_filename,
            
            'passport_exp_date' => $new_passport_expiry, 
            'passport_copy' => $passport_data,
            
            'visa_copy' => $visa_data,
            
            'dl_copy' => $dl_data,
            'dl_expiry' => $new_dl_expiry,
            
            
            'edu_certificate' => $education_data,
            
            'emirates_id' => $emirate_id,
            'emi_certificate' => $emi_certificate,
            
            'lab_expiry' => $new_labour_card_date,
            'lab_certificate' => $lab_data,
            
            'exp_certificate' => $exp_cer_data,
            
            'is_active' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        );

        //dd($values);

         DB::table('documents')->insert($values);

         return redirect()->route('employee.index')->withStatus(__('Documents successfully created.'));

       }

       public function edit($id)
        {   
    //dd($id);

        $matchThese = ['employee_id' => $id];

      //  $results = Document::where($matchThese)->get();

        $results = Document::with('employees')->where($matchThese)->get();
       //dd($results);
        
        //$emp = Employee::find($id);
        return view('employee.documents.edit',['documents' => $results]);
  
        }
        
        
    public function update(Request $request, $id, Document $model)
    {   
        //dd($id);

        $validatedData = $request->validate([
            'employee_id' => 'required|unique:documents,employee_id,'.$request->employee_id.',employee_id',
            'passport_photo' => 'required',
            
            'passport_expiry.*' => 'required|date',
            'passport_copy.*' => 'required|mimes:jpeg,jpg,png,doc,docx,pdf',
                
            'visa_copy.*' => 'required|mimes:jpeg,jpg,png,doc,docx,pdf',
                        
            //'dl_copy.*' => 'required|mimes:jpeg,jpg,png,doc,docx,pdf',
            //'dl_expiry.*' => 'required|date',
            
            
            'edu_certificate.*' => 'required|mimes:jpeg,jpg,png,doc,docx,pdf',
                
            'emirate_id' => 'required',
            'emi_certificate.*' => 'required|mimes:jpeg,jpg,png,doc,docx,pdf',
            
            'lab_expiry' => 'required|date',
            'lab_certificate.*' => 'required|mimes:jpeg,jpg,png,doc,docx,pdf',
            
            'exp_certificate.*' => 'required|mimes:jpeg,jpg,png,doc,docx,pdf',
        ]);
          
    //dd($request);
//dd($request->codes);
       // dd($request->all());

       if($request->hasfile('passport_photo'))
        {
           $passport_photo = $request->passport_photo;

           $destinationPath ='passport_photo/';
        
           $passport_photo_file_filename = $passport_photo->getClientOriginalName();

           $passport_photo->move($destinationPath, $passport_photo_file_filename);
 
       }

         if($request->hasfile('passport_copy'))
         {
            
               $passport_copy = $request->file('passport_copy');

                foreach ($passport_copy as $passport_copy_file) {
                    //$name = time().'-'.$passport_photo->extension();
                    $passport_copy_file_filename = $passport_copy_file->getClientOriginalName();
                    $passport_copy_file->move('passport_copy/', $passport_copy_file_filename);
                    $passport_copy_data[] = $passport_copy_file_filename; 
                }

               // dd($passport_copy_data);

         }

         if($request->hasfile('visa_copy'))
         {
            
                $visa_copy = $request->file('visa_copy');

                foreach ($visa_copy as $visa_copy_file) {
                    //$name = time().'-'.$passport_photo->extension();
                    $visa_copy_file_filename = $visa_copy_file->getClientOriginalName();
                    $visa_copy_file->move('visa_copy/', $visa_copy_file_filename);
                    $visa_copy_data[] = $visa_copy_file_filename; 
                }

               // dd($visa_copy_data);

         }
         
         if($request->hasfile('dl_copy'))
         {
            
                $dl_copy = $request->file('dl_copy');

                foreach ($dl_copy as $dl_copy_file) {
                    //$name = time().'-'.$passport_photo->extension();
                    $dl_copy_file_filename = $dl_copy_file->getClientOriginalName();
                    $dl_copy_file->move('dl_copy/', $dl_copy_file_filename);
                    $dl_copy_data[] = $dl_copy_file_filename; 
                }

                //dd($dl_copy_data); emirate_copy

         }
         else
         $dl_copy_data = ""; 

         if($request->hasfile('edu_certificate'))
         {
            
                $files = $request->file('edu_certificate');

                foreach ($files as $file) {
                    //$name = time().'-'.$passport_photo->extension();
                    $filename = $file->getClientOriginalName();
                    $file->move('education_certificate/', $filename);
                    $edu_certificate_data[] = $filename; 
                }

                //dd($edu_certificate_data);
            }

            if($request->hasfile('emi_certificate'))
            {
                 $files = $request->file('emi_certificate');
                 foreach ($files as $file) {
                       //$name = time().'-'.$passport_photo->extension();
                       $filename = $file->getClientOriginalName();
                       $file->move('emirates_certificate/', $filename);
                       $emi_certificate_data[] = $filename;    
                   }   
                //dd($edu_certificate_data);
             }
             if($request->hasfile('lab_certificate'))
             {
                  $files = $request->file('lab_certificate');
                  foreach ($files as $file) {
                        //$name = time().'-'.$passport_photo->extension();
                        $filename = $file->getClientOriginalName();
                        $file->move('labour_certificate/', $filename);
                        $lab_card_data[] = $filename;    
                    }   
                 //dd($edu_certificate_data);
              }

              
         if($request->hasfile('exp_certificate'))
         {
            
                $files = $request->file('exp_certificate');
                
                foreach ($files as $file) {
                    //$name = time().'-'.$passport_photo->extension();
                    $filename = $file->getClientOriginalName();
                    $file->move('exp_certificate/', $filename);
                    $exp_certificate_data[] = $filename; 
                }

               // dd($exp_certificate_data); emirate_copy

         }
         else
         $exp_certificate_data = "";

        $dl_expiry = $request->dl_expiry;
        $lab_expiry = $request->lab_expiry;
      //  dd($lab_expiry);
        $new_dl_expiry = date("Y-m-d", strtotime($dl_expiry));   
        if($new_dl_expiry == "1970-01-01")
        $new_dl_expiry = "";
        
        $new_labour_card_date = date("Y-m-d", strtotime($lab_expiry));

        $passport_expiry = $request->passport_expiry;
        $new_passport_expiry = date("Y-m-d", strtotime($passport_expiry)); 

        $passport_data = implode(',', array_values($passport_copy_data));
        $visa_data = implode(',', array_values($visa_copy_data));
       // dd($dl_copy_data);
        if($dl_copy_data !== "")
        $dl_data = implode(',', array_values($dl_copy_data));
        else
        $dl_data = "";
        
        $education_data = implode(',', array_values($edu_certificate_data));
       
        if($exp_certificate_data !== "")
        $exp_cer_data = implode(',', array_values($exp_certificate_data));
        else
        $exp_cer_data = "";
        $emi_certificate = implode(',', array_values($emi_certificate_data));
        $lab_data = implode(',', array_values($lab_card_data));
        $emirate_id = $request->emirate_id;


        //dd($id);
        
        
            $result = DB::table('documents')
                ->where('document_id', $id)
                ->update([
                'employee_id' => $request->employee_id,
                'passport_photo' => $passport_photo_file_filename,
                
                'passport_exp_date' => $new_passport_expiry, 
                'passport_copy' => $passport_data,
                
                'visa_copy' => $visa_data,
                
                'dl_copy' => $dl_data,
                'dl_expiry' => $new_dl_expiry,
             
                'edu_certificate' => $education_data,
             
                'emirates_id' => $emirate_id,
                'emi_certificate' => $emi_certificate,
                 
                'lab_expiry' => $new_labour_card_date,
                'lab_certificate' => $lab_data,
                
                'exp_certificate' => $exp_cer_data,

                'is_active' => '1',

                'updated_at' => Carbon::now()
                
               
             ]);
       
 
        //dd($result);
        //$model->update($request->all());

        return redirect()->route('employee.index')->withStatus(__('Document successfully updated.'));
    }

    public function view_documents(Request $request)
    {  
    // dd($request->id);
      //return $request->id;

       // $result = DB::table('documents')->where('document_id',$request->id)->get();
               
              
        $matchThese = ['is_active' => '1'];

        $results = Document::with('employees')->where($matchThese)->where('employee_id',$request->id)->get();
        
        return response()->json($results);

    }
    public function view_documentsfields(Request $request)
    {  
    // dd($request->id);
      //return $request->id;

       // $result = DB::table('documents')->where('document_id',$request->id)->get();
               
              
        $matchThese = ['is_active' => '1'];

        $results = Document::with('employees')->where($matchThese)->where('employee_id',$request->id)->get();
        
        return response()->json($results);

    }
    


}
