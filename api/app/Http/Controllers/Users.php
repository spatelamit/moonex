<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Validator; 
use Carbon\Carbon;
use Tymon\JWTAuth\Facades\JWTAuth;



class Users extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['send_otp', 'verify_otp'] ]);
        
    }

 public function verify_otp(Request $request){
        $valid = Validator::make($request->all(), [ 
            'mobile' => 'required|digits:10', //max:16|
            'otp' => 'required|digits:4', //max:16|

        ]);
        


        if(!$valid->fails())
        {
           $result  = User::where('mobile', $request->mobile)
                        ->where('otp', $request->otp)
                        ->first();
            $UserModel = new User;

            if(isset($result)){
                try {
                            // verify the credentials and create a token for the user
                            if (! $token = JWTAuth::fromUser($result)) {
                                return response()->json(['error' => 'invalid_credentials'], 401);

                            }
                        } catch (JWTException $e) {
                            // something went wrong
                            return response()->json(['error' => 'could_not_create_token'], 500);
                        }

                        // print_r( $token);
                        // print_r( auth());
                          return response()->json([
                            'access_token' => $token,
                            'token_type' => 'bearer',
                            'expires_in' => auth()->factory()->getTTL() * 60,
                        ]);





                    return response()->json([
                        'message' => 'OTP Verification successfully.',
                        'data'=>$array,
                        'status' => 200,
                    ], 200);



            }
            else{
                 return response()->json([
                    'message' => 'OTP Verification Failed.!',
                    'status' => 403,
                 ], 403);
            }
        }else{
              return response()->json([
            'message' => $valid->errors(),
            'status' => 403,
         ], 403); 
        }


     }


     public function send_otp(Request $request){
        $validated = Validator::make($request->all(), [ 
            'mobile' => 'required|digits:10', //max:16|
        ]);
        

        if(!$validated->fails())
        {
           $result  =  User::where('mobile', $request->mobile)
                        ->first();
            $otp  = rand(9999,1111);
             $sender = 'MOSFTY';
                    $message  = urlencode("Dear User Your Txn Validation OTP Is $otp , Thanks Team MOSFTY");
                    $template = '1707164930183344222';

            $UserModel = new User;
                   
            if(isset($result)){
                 if($UserModel->sendOTP($otp, $result->mobile)==true){
                      Carbon::now('+5 minutes');
                    //return $result->updated_at;
                    if(Carbon::now('+5 minutes')->lte($result->updated_at)){
                        echo "expired";
                    }

                    // else{
                    //     echo "not expired";

                    // }
                    //return $result->updated_at;
                    // return $expiredAt = Carbon::parse($result->updated_at);
                    // return Carbon::now()->lte($expiredAt); // You can directly return the value of the comparison

                   // die;
                    
                    $url = 'http://sms.bulksmsserviceproviders.com/api/send_http.php?authkey=46a57c629565ac350bae4264c3e82d9e&mobiles='.$request->mobile.'&message='.$message.'&sender='.$sender.'&route=B';
                    //echo $link = "https://securesmpp.com/api/sendmessage.php?usr=HARSH&apikey=E3E92ECD84DD01F0E647&sndr=".urlencode($senderid)."&ph=".urlencode($result->mobile)."&Template_ID=".urlencode($template)."&message=".urlencode($message)."";

                       file_get_contents($url);

                    // $ch = curl_init();
                    // curl_setopt($ch,CURLOPT_URL,$link);
                    // curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
                    // curl_setopt($ch,CURLOPT_HEADER, false);
                    // echo $result=curl_exec($ch);
                    // curl_close($ch);


                    User::where('mobile', $request->mobile)
                        ->update(['otp'=>$otp]);
                    return response()->json([
                        'message' => 'OTP sent successfully to you mobile. ',
                        'status' => 200,
                    ], 200);
                 }
                //sendOTP($otp);
            }
            else{
                 if($UserModel->sendOTP($otp, $request->mobile)==true){
                       
                       
                    $url = 'http://sms.bulksmsserviceproviders.com/api/send_http.php?authkey=46a57c629565ac350bae4264c3e82d9e&mobiles='.$request->mobile.'&message='.$message.'&sender='.$sender.'&route=B';

                     file_get_contents($url);
                    

                    DB::table('users')->insert(['mobile'=> $request->mobile,'otp'=>$otp]);
                    return response()->json([
                        'message' => 'OTP sent successfully to you mobile. ',
                        'status' => 200,
                    ], 200);
                 }
                //sendOTP($otp);
            }
        }else{
              return response()->json([
            'message' => $validated->errors(),
            'status' => 403,
         ], 403); 
        }


     }

    

     protected function generateToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ]);
    }
   
    public function logout() {
        auth()->logout();
         return response()->json([
                        'message' => 'Account logged out successfully.',
                        'status' => 200,
                    ], 200);
    }


     public function get_user(Request $request){

        $result  =  DB::table('users')->select('firstname', 'lastname', 'fathername', 'gender', 'mobile', 'PAN', 'Panname', 'PAN_image', 'selfie', 'dob', 'aadhar', 'aadhar_f', 'aadhar_b', 'address', 'city', 'state', 'pincode', 'AccountNumber', 'Ac_type', 'IFSC', 'BranchName', 'NameAsAccount', 'job_type', 'job_role', 'monthly_salary',  'office_address', 'office_company_name', 'office_city', 'office_state', 'office_country', 'office_pincode', 'office_email', 'office_contact', 'kyc_status', 'loan_status', 'amount', 'updated_at')->where('id', Auth::id())->first();
            // $otp  = rand(9999,1111);
            // $UserModel = new User;

            if(isset($result)){
                $result->PAN_image = url('/documents').'/'.$result->PAN_image;
                $result->aadhar_f = url('/documents').'/'.$result->aadhar_f;
                $result->aadhar_b = url('/documents').'/'.$result->aadhar_b;
                $result->selfie = url('/documents').'/'.$result->selfie;

                
              

                    return response()->json([
                        'data'=>$result,
                        'status' => 200,
                    ], 200);
            }
            else{
                 return response()->json([
                    'message' => 'User Not Found',
                    'status' => 403,
                 ], 403);
            }


     }

      public function verify_pan(Request $request){
        $validated = Validator::make($request->all(), [ 
            'PAN' => 'required|min:10|max:10', //max:16|
        ]);
        

        if(!$validated->fails())
        {
            //BNZPM2501F
            //  "firstName": "DURAISAMY",
           

                    $curl = curl_init();
                        curl_setopt_array($curl, array(
                          CURLOPT_URL => "https://signzy.tech/api/v2/patrons/login",
                          CURLOPT_RETURNTRANSFER => true,
                          CURLOPT_ENCODING => "",
                          CURLOPT_MAXREDIRS => 10,
                          CURLOPT_TIMEOUT => 30,
                          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                          CURLOPT_CUSTOMREQUEST => "POST",
                          CURLOPT_POSTFIELDS => "{\"username\":\"moonex_prod\",\"password\":\"gBGRM4sPkOc9p6BnMcte\"}",
                          CURLOPT_HTTPHEADER => array(
                            "accept: */*",
                            "accept-language: en-US,en;q=0.8",
                            "content-type: application/json"
                          ),
                        ));

                        $response = curl_exec($curl);
                        $err = curl_error($curl);

                        curl_close($curl);

                        if ($err) {
                          echo "cURL Error #:" . $err;
                        } else {
                          echo $response;
                          echo "<pre><br>";
                          $res = json_decode($response,true);
                         // print_r($res);
                        }
                        //die;
                          echo "<pre><br>";

            //      echo "hao";
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                      CURLOPT_URL => "https://signzy.tech/api/v2/patrons/".$res['userId']."/panv2",
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => "",
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 30,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => "POST",
                      CURLOPT_POSTFIELDS => "{\"task\":\"fetch\",\"essentials\":{\"number\":\"$request->PAN\"}}",
                      CURLOPT_HTTPHEADER => array(
                        "accept: /",
                        "accept-language: en-US,en;q=0.8",
                        "authorization: ".$res['id'],
                        "content-type: application/json"
                      ),
                    ));

                    $response = curl_exec($curl);
                    $err = curl_error($curl);

                    curl_close($curl);

                    if ($err) {
                      echo "cURL Error #:" . $err;
                    } else {
                      echo $response;
                    }



        }else{
              return response()->json([
            'message' => $validated->errors(),
            'status' => 403,
         ], 403); 
        }


     }



 public function update_user_profile(Request $req){
    

        if(!$validated->fails())
        {
                $arrayName = array();

                if($req->mobile){
                    $arrayName['mobile']=$req->mobile;
                }

                if($req->PAN){
                        $arrayName['PAN']=$req->PAN;
                }
                if($req->Panname){
                        $arrayName['Panname']=$req->Panname;
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
                if($req->Ac_type){
                        $arrayName['Ac_type']=$req->Ac_type;
                }
                

                if($req->job_type){
                        $arrayName['job_type']=$req->job_type;
                }
                if($req->job_role){
                        $arrayName['job_role']=$req->job_role;
                }
                if($req->monthly_salary){
                        $arrayName['monthly_salary']=$req->monthly_salary;
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
                if($req->file('selfie')){
                            $file = $req->file('selfie');
                            $file_name = time().$file->getClientOriginalName();
                            $file->move('documents', $file_name);
                            $selfie = $file_name;
                            $arrayName['selfie']=$selfie;
                }
                

                // if($req->file('enach_response')){
                //     $arrayName['enach_response']=$req->enach_response;

                // }
                //echo "<pre>";
                // echo json_encode($arrayName,JSON_PRETTY_PRINT);
                // die;

        $data['user'] = User::where('id',Auth::id())->update($arrayName);
        
        return response()->json([
                        'message' => 'profile updated successfully.',
                        'status' => 200,
                    ], 200);

        }
        else{
                  return response()->json([
                'message' => $validated->errors(),
                'status' => 403,
             ], 403); 
            }
    }



 public function save_enach_response(Request $request){
        $validated = Validator::make($request->all(), [ 
            'response' => 'required|min:5' //max:16|
        ]);

        if(!$validated->fails())
        {
                $array = array();
                $array['user_id']=Auth::id();
                $array['response']=$request->response;
                $query = DB::table('enach_responses')->insert($array);

                // $user_status = User::where('id',Auth::id())->update($data);
        
            return response()->json([
                        'message' => 'Response save successfully',
                        'status' => 200,
                    ], 200);
             }
        else{
                  return response()->json([
                'message' => $validated->errors(),
                'status' => 403,
             ], 403); 
            }
    }



 // public function set_username_password(Request $request){
 //        $validated = Validator::make($request->all(), [ 
 //            'username' => 'required|unique:users|min:5|max:12', //max:16|
 //            'password' => 'required|min:5|confirmed',
 //            'password_confirmation' => 'required|min:5'

 //        ]);

 //        if(!$validated->fails())
 //        {
 //                $arrayName = array();
 //                    $arrayName['username']=$request->username;
 //                    $arrayName['password']=$request->password;

 //         $data['user'] = User::where('id',Auth::id())->update($arrayName);
        
 //        return response()->json([
 //                        'message' => 'username and passowrd updated successfully.',
 //                        'status' => 200,
 //                    ], 200);

 //        }
 //        else{
 //                  return response()->json([
 //                'message' => $validated->errors(),
 //                'status' => 403,
 //             ], 403); 
 //            }
 //        }


 //     public function set_password(Request $request){
 //        $validated = Validator::make($request->all(), [ 
 //            'password' => 'required|min:5|confirmed',
 //            'password_confirmation' => 'required|min:5'

 //        ]);

 //        if(!$validated->fails())
 //        {
 //                $arrayName = array();
 //                    $arrayName['password']=$request->password;

 //         $data['user'] = User::where('id',Auth::id())->update($arrayName);
        
 //        return response()->json([
 //                        'message' => 'passowrd updated successfully.',
 //                        'status' => 200,
 //                    ], 200);

 //        }
 //        else{
 //                  return response()->json([
 //                'message' => $validated->errors(),
 //                'status' => 403,
 //             ], 403); 
 //            }
 //        }

}
