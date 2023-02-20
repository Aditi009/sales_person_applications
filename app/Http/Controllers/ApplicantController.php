<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Validator; 

use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    public function index(){
        return view('index');
    }

   public function store(Request $request){
    $data['title'] = 'application';       
        
    $rules = [
        'email1'          => 'required|email|unique:users,email',
        'email2'          => 'required|email|unique:users,email',
        'name1'          => 'required',
        'name2'          => 'required',
        'title1'          => 'required|string',
        'title2'          => 'required|string',
        'dob1'            => 'required',
        'dob2'            => 'required',
        'gender1'            => 'required',
        'gender2'            => 'required',
        'address2'           => 'required',
        'address1'           => 'required',
        'post1'              => 'required',
        'post2'              => 'required',
        'customer_id2'       => 'required',
        'customer_id1'      => 'required',
        'phone_no2'         => 'required',
        'phone_no1'         => 'required',
        'mobile_no1'         => 'required',
        'mobile_no2'         => 'required',
        'application_id1'    => 'required',
        'application2'    => 'required',

        


    ];
    $custom = [
        'email1.required' => "Email Field is required Applicant 1",
        'email2.required' => "Email Field is required Applicant 2",
        'name2.required' => "Name Field is required Applicant 2",
        'name1.required' => "Name Field is required Applicant 1",
        'title1.required' => "Title Field is required Applicant 1",
        'title2.required' => "Title Field is required Applicant 2",
        'dob1.required' => "DOB Field is required Applicant 1",
        'dob2.required' => "DOB Field is required Applicant 2",
        'application_id1' => "Application Id is required Applicant 1"



    ];
       # Validating user inputs
       $validator = Validator::make($request->all(), $rules,$custom);

       # If validators fails then return errors
       if ($validator->fails()) {
           $data['response'] = 'errors';
           $data['errors']   = $validator->errors();
       }else{
            $app1 = new Applicant();
            $app1->applicant_type = 1;
            $app1->title = $request->title1;
            $app1->dob = $request->dob1;
            $app1->name = $request->name1;
            $app1->phone_no = $request->phone_no1;
            $app1->mobile_no = $request->mobile_no1;
            $app1->gender = $request->gender1;
            $app1->address = $request->address1;
            $app1->email = $request->email1;
            $app1->application_id = $request->application_id1;
            $app1->post_or_zip = $request->post1;
            $app1->customer_id = $request->customer_id1;
            $app1->gender = $request->gender1;

            $app1->save();

            $app1 = new Applicant();
            $app1->applicant_type = 2;
            $app1->title = $request->title2;
            $app1->dob = $request->dob2;
            $app1->name = $request->name2;
            $app1->post_or_zip = $request->post2;
            $app1->address = $request->address2;
            $app1->customer_id = $request->customer_id2;
            $app1->application_id = $request->application2;
            $app1->gender = $request->gender2;
            $app1->phone_no = $request->phone_no2;
            $app1->mobile_no = $request->mobile_no2;
            $app1->email = $request->email2;
            $app1->application_id = $request->application_id2;
            $app1->save();
            $data['redirect_url']   = route('index');
            $data['response']       = 'success';
            $data['message']        =  "Applicant Added Successfully";

       }
       return $data;
}

public function getAppData(Request $request){
    if($request->email){
    $data = Applicant::where('email',$request->email)->first();
    }elseif($request->mobile){
    $data = Applicant::where('mobile_no',$request->mobile)->first();
    }
    if($data){
        return response()->json(['status'=>true,'data'=>$data]);
    }else{
        return response()->json([]);
    }
}
}
