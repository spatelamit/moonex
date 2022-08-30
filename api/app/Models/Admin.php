<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Admin extends Model
{
    use HasFactory;

     public function getTotalLoanProfiles(){
        $query =  DB::table('users')->get();
        return $query->count();
                //  return DB::table('users')
                // ->select('kyc_status','loan_status')
                // ->selectRaw('sum(1) as total_count')
                // ->selectRaw('count(kyc_status) as kyc_count')
                // ->selectRaw('count(loan_status) as loan_count')
                // ->groupBy('kyc_status', 'loan_status')
                // ->get();

             // return DB::table('users')->select('kyc_status', 'loan_status')->groupBy('kyc_status', 'loan_status')->count('kyc_status', 'loan_status');
     }
     
     public function getTotalRejectProfile(){
        $query =  DB::table('users')->select('kyc_status')
                            ->selectRaw('count(*) as rejected_kyc')
                            ->where('kyc_status',2)
                            ->count();
        return $query;
     }

 public function getRejectedProfile(){
        $query =  DB::table('users')->where('kyc_status',2)
                            ->paginate(10);
        return $query;
     }

    public function getTotalProfile(){
       $query =  DB::table('users')->get();
        return $query->count();
     }
     public function getTotalPendingProfile(){
       $query =  DB::table('users')->where('kyc_status',0)->get();
        return $query->count();
     }
      public function getSanctionedLoanAmount(){
      return $query =  DB::table('users')
                    ->where('kyc_status',1)
                    ->where('loan_status',1)
                    ->sum('amount');
     }
     
     
     

     public function getSetting(){
        return DB::table('admins')
                ->where('id',session()->has('AdminId'))
                ->first();

             // return DB::table('users')->select('kyc_status', 'loan_status')->groupBy('kyc_status', 'loan_status')->count('kyc_status', 'loan_status');
     }

     


    
}
