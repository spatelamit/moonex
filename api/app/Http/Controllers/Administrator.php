<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use Redirect;
use Validator;


use Session;


class Administrator extends Controller
{
    //   


    
    public function login(){
        if (session()->has('AdminId')) {
            return redirect("dashboard");
        }
        $data['heading'] = "Login";
        return view('login', $data);
    }

    
     public function loginaction(Request $req){

            $result  =  Admin::where('username', $req->username)
                        ->where('password', $req->password)
                        ->where('status', 1)
                        ->first();

        if ($result) {
            Session::put('AdminData', $result);
            Session::put('IsLoggedIn', true);
            Session::put('Username', $result->username);
            Session::put('AdminId', $result->id);
            return Redirect::to('/dashboard')->with('success', 'Login Successfully.!');
        }
        else{
            //return response()->json(['status'=>'Failed','message'=>'Invalid Credentials']);

            if (!session()->has('AdminId')) {
                return back()->with('error', 'Invalid Credetials.');
                }
        }
    }
    public function dashboard(){
        if (!session()->has('AdminId')) {
            return redirect('/');
        }

        $Admin = new Admin;
        $data['TotalLoanProfiles'] = $Admin->getTotalLoanProfiles();
        $data['TotalRejectProfile'] = $Admin->getTotalRejectProfile();
        $data['TotalProfile'] = $Admin->getTotalProfile();
        $data['TotalPendingProfile'] = $Admin->getTotalPendingProfile();
        $data['SanctionedLoanAmount'] = $Admin->getSanctionedLoanAmount();
        
        
        
        $data['heading'] = "Dashboard";

        return view('dashboard', $data);
    }

   public function setting(){
        if (!session()->has('AdminId')) {
            return redirect('/');
        }

        $Admin = new Admin;
        $data['setting'] = $Admin->getSetting();
        $data['heading'] = "Setting";

        return view('setting', $data);
    }

    public function update_setting( Request $req){
        if (!session()->has('AdminId')) {
            return redirect('/');
        }
        $validate = Validator::make($req->all(), [ 
            'email' => 'required',
            'mobile' => 'required',
            'password' => 'min:4',
            'password_confirm' => 'confirmed'
        ]);
        if(!$validate->fails()){
            $arrayName = array('email'=>$req->email,
                                 'mobile'=>$req->mobile);
            $data['setting'] = Admin::where('id', $req->id)->update($arrayName);

           return Redirect::to('/setting')->with('success', 'Admin Setting updated Successfully.!');
       }else{


           return Redirect::to('/setting')->withErrors($validate);

       }

    }

    public function logout()
    {

        if (session()->has('AdminId')) {
            session()->pull('AdminId');
            // return redirect('/admin/login');

           return Redirect::to('/')->with('success', 'Logout Successfully.!');
        }
        return Redirect::to('/')->with('success', 'Logout Successfully.!');
    }

    public function users_list(){
        if (!session()->has('AdminId')) {
            return redirect('/');
        }
         $data['users'] = User::orderBy('id', 'DESC')->paginate(10);
        $data['heading'] = "Users List ";
        return view('users_list', $data);
    }
     public function kyc_verification(){
        if (!session()->has('AdminId')) {
            return redirect('/');
        }
         $data['users'] = User::orderBy('id', 'DESC')->paginate(10);
        $data['heading'] = "KYC Verification";
        return view('users_list', $data);
    }
    
     public function kyc_approved(){
        if (!session()->has('AdminId')) {
            return redirect('/');
        }
         $data['users'] = User::where('kyc_status',1)->orderBy('id', 'DESC')->paginate(10);
        $data['heading'] = "Users List ";
        return view('users_list', $data);
    }

     public function loan_approved(){
        if (!session()->has('AdminId')) {
            return redirect('/');
        }
         $data['users'] = User::where('loan_status',1)->orderBy('id', 'DESC')->paginate(10);
        $data['heading'] = "Users List ";
        return view('users_list', $data);
    }
     public function disbursal_pending(){
        if (!session()->has('AdminId')) {
            return redirect('/');
        }
         $data['users'] = User::where('loan_status',1)->orderBy('id', 'DESC')->paginate(10);
        $data['heading'] = "Disbursal Pending";
        return view('users_list', $data);
    }




      public function loan_profile($profile_id){
        if (!session()->has('AdminId')) {
            return redirect('/');
        }
         $data['user'] = User::where('id',$profile_id)->first();
         //return  $data['user'];
        $data['heading'] = "loan_profile ";
        return view('loan_profile', $data);
    }
    public function save_profile(Request $req){
        if (!session()->has('AdminId')) {
            return redirect('/');
        }
            
            $arrayName = array();

                if($req->mobile){
                    $arrayName['mobile']=$req->mobile;
                }

                if($req->PAN){
                        $arrayName['PAN']=$req->PAN;
                }
                if($req->aadhar){
                        $arrayName['aadhar']=$req->aadhar;
                }
                if($req->gender){
                    $arrayName['gender']=$req->gender;
                }

                if($req->firstname){
                    $arrayName['firstname']=$req->firstname;
                }
                if($req->lastname){
                    $arrayName['lastname']=$req->lastname;
                }

                if($req->fathername){
                        $arrayName['fathername']=$req->fathername;
                }
                if($req->dob){
                        $arrayName['dob']=$req->dob;
                }
                if($req->address){
                        $arrayName['address']=$req->address;
                }
                if($req->city){
                        $arrayName['city']=$req->city;
                }
                if($req->state){
                        $arrayName['state']=$req->state;
                }
                if($req->pincode){
                        $arrayName['pincode']=$req->pincode;
                }
                if($req->AccountNumber){
                        $arrayName['AccountNumber']=$req->AccountNumber;
                }

                if($req->IFSC){
                        $arrayName['IFSC']=$req->IFSC;
                }
                if($req->BranchName){
                        $arrayName['BranchName']=$req->BranchName;
                }
                if($req->NameAsAccount){
                        $arrayName['NameAsAccount']=$req->NameAsAccount;
                }
                if($req->office_address){
                        $arrayName['office_address']=$req->office_address;
                }
                if($req->office_company_name){
                    $arrayName['office_company_name']=$req->office_company_name;
                }
                if($req->office_city){
                    $arrayName['office_city']=$req->office_city;
                }
                if($req->office_state){
                    $arrayName['office_state']=$req->office_state;
                }
                if($req->office_country){
                    $arrayName['office_country']=$req->office_country;
                }
                if($req->office_pincode){
                    $arrayName['office_pincode']=$req->office_pincode;
                }
                if($req->office_email){
                    $arrayName['office_email']=$req->office_email;
                }
                if($req->office_contact){
                    $arrayName['office_contact']=$req->office_contact;
                }
                if($req->kyc_status){
                        $arrayName['kyc_status']=$req->kyc_status;
                }
                if($req->loan_status){
                        $arrayName['loan_status']=$req->loan_status;
                }

                if($req->file('aadhar_f')){
                            $file = $req->file('aadhar_f');
                            $file_name = time().$file->getClientOriginalName();
                            $file->move('documents', $file_name);
                            $aadhar_f = $file_name;
                            $arrayName['aadhar_f']=$aadhar_f;
                }

                if($req->file('aadhar_b')){
                            $file = $req->file('aadhar_b');
                            $file_name = time().$file->getClientOriginalName();
                            $file->move('documents', $file_name);
                            $aadhar_b = $file_name;
                            $arrayName['aadhar_b']=$aadhar_b;
                }

                if($req->file('PAN_image')){
                            $file = $req->file('PAN_image');
                            $file_name = time().$file->getClientOriginalName();
                            $file->move('documents', $file_name);
                            $PAN_image = $file_name;
                            $arrayName['PAN_image']=$PAN_image;
                }

        $data['user'] = User::where('id',$req->id)->update($arrayName);
     return Redirect::to('/users_list')->with('success', 'User profile updated Successfully.!');
    }
    


public function reports(){
        if (!session()->has('AdminId')) {
            return redirect('/');
        }

        $Admin = new Admin;
        $data['TotalLoanProfiles'] = $Admin->getTotalLoanProfiles();
        $data['TotalRejectProfile'] = $Admin->getTotalRejectProfile();
        $data['TotalProfile'] = $Admin->getTotalProfile();
        $data['TotalPendingProfile'] = $Admin->getTotalPendingProfile();
        $data['SanctionedLoanAmount'] = $Admin->getSanctionedLoanAmount();
        
        
        
        $data['heading'] = "Reports";

        return view('reports', $data);
    }

    public function reject_profile(){
        if (!session()->has('AdminId')) {
            return redirect('/');
        }

        $Admin = new Admin;
        $data['RejectedProfile'] = $Admin->getRejectedProfile();
        
        
        
        $data['heading'] = "Reject Profile";

        return view('rejected_profile', $data);
    }

    public function enach_api(Request $req){
        if (!session()->has('AdminId')) {
            return redirect('/');
        }

        $Admin = new Admin;
        //$data['enach_api'] = $Admin->enach_api();
        
        $data['heading'] = "Enach Api";
        $data['request'] = "";

        return view('enach_api', $data);
    }


}
