<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Application;
use Validator; 

use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    public function getPage(Request $request){
        $data = '';
        $email = '';
       if($request->email){
         $data = Applicant::where('email',$request->email)->first();
         if(!$data){
                $email = $request->email;
         }
         
       }
       return view('index2',compact('email','data'));
    }
    public function index(){
        return view('index');
    }
    public function index2(){
        return view('index2');
    }

   public function store(Request $request){
    $data['title'] = 'application';       
        
    $rules = [
        'email1'          => 'required|email',
        'email2'          => 'required|email',
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
        'sale_amount'     => 'required',
        'service_product' => 'required',
        'package_detail'  => 'required',
        'type'            => 'required'

        


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
            $email1exist=Applicant::where('email',$request->email1)->orWhere('mobile_no',$request->mobile_no1)->first();
            if(!$email1exist)
            {
            $app1->save();
            }

            $app2 = new Applicant();
            $app2->applicant_type = 2;
            $app2->title = $request->title2;
            $app2->dob = $request->dob2;
            $app2->name = $request->name2;
            $app2->post_or_zip = $request->post2;
            $app2->address = $request->address2;
            $app2->customer_id = $request->customer_id2;
            $app2->application_id = $request->application2;
            $app2->gender = $request->gender2;
            $app2->phone_no = $request->phone_no2;
            $app2->mobile_no = $request->mobile_no2;
            $app2->email = $request->email2;
            $app2->application_id = $request->application_id2;
            $email2exist=Applicant::where('email',$request->email2)->orWhere('mobile_no',$request->mobile_no2)->first();
            if(!$email2exist)
            {
            $app2->save();
            }

            $application = new Application();
            $application->type = $request->type;
            $application->applicant_id =  $app1->id?$app1->id:$email1exist->id;
            $application->applicant_id2 =  $app2->id?$app2->id:$email2exist->id;
            $application->service_product=$request->service_product;
            $application->sale_amount=$request->sale_amount;
            $application->package_details=$request->package_detail
            ;


            $application->save();
            
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
        return response()->json(['status'=>false,'data'=>null]);
    }
}

public function getEmailListData(Request $request){
    if($request->email){
        $data = Applicant::select('email')->where('email', 'like', '%' . $request->email . '%')->get();
        }elseif($request->mobile){
        $data = Applicant::where('mobile_no', 'like', '%' . $request->mobile . '%')->get();
        }
        if($data){
            return response()->json(['status'=>true,'data'=>$data]);
        }else{
            return response()->json(["status"=>false,'data'=>[]]);
        }
}

public function getMobileListData(Request $request){
    if($request->email){
        $data = Applicant::select('email')->where('name', 'like', '%' . $request->email . '%')->get();
        }elseif($request->mobile){
        $data = Applicant::where('mobile_no', 'like', '%' . $request->mobile . '%')->get();
        }
        if($data){
            return response()->json(['status'=>true,'data'=>$data]);
        }else{
            return response()->json(["status"=>false,'data'=>[]]);
        }
}

public function slide2(){

    $images = [
        asset('assets/images/1.png'),
        asset('assets/images/2.png'),
        asset('assets/images/3.png'),
        asset('assets/images/4.png'),
        asset('assets/images/5.png'),
        asset('assets/images/6.png'),
        asset('assets/images/7.png'),
        asset('assets/images/8.png'),
        asset('assets/images/9.png'),
        asset('assets/images/10.png'),
        asset('assets/images/11.png'),
        asset('assets/images/12.png'),
        asset('assets/images/13.png'),


    ];
    
    return view('slide2',compact('images'));
}
public function thankYou(){
    return view('thank-you');

}
}
