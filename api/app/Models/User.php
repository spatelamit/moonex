<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;




class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */


    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    } 

        public function sendOTP($Otp, $Mobile){
            
            $message  = "Dear User Your Txn Validation OTP Is $Otp , Thanks Team MOSFTY";
            $sender = "MOSFTY";
            $template = '1707164930183344222';


            //https://securesmpp.com/api/sendmessage.php?usr=HARSH&apikey=E3E92ECD84DD01F0E647&sndr=MOSFTY&ph=7697588851&Template_ID=1707164930166195486&message=Dear,%20User%20Your%20Txn%20Validation%20OTP%20Is%20123456%20,Thanks%20Team%20Moonex%20Software
            $url = "https://securesmpp.com/api/sendmessage.php?usr=HARSH&apikey=E3E92ECD84DD01F0E647&sndr=".$sender."&ph=".$Mobile."&Template_ID=".$template."&message=".$message."";
            file_get_contents($url);
            return true;

        }
}
