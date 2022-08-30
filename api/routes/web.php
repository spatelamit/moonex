<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Administrator;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [Administrator::class, 'login']); 


//Route::get('/', [Admin::class, 'login']); 
// Route::get('/login', [Admin::class, 'login']); 

Route::post('/loginaction', [Administrator::class, 'loginaction']); 
Route::get('/logout', [Administrator::class, 'logout']); 

Route::group(['middleware' => 'admin:web'], function ($router) {
        Route::get('/dashboard', [Administrator::class, 'dashboard']); 
        Route::get('/loan_profile/{user_id}', [Administrator::class, 'loan_profile']); 
        Route::post('/save_profile', [Administrator::class, 'save_profile']); 
        Route::get('/setting', [Administrator::class, 'setting']); 
        Route::post('/update_setting', [Administrator::class, 'update_setting']); 
        Route::get('/reports', [Administrator::class, 'reports']); 
        Route::get('/reject_profile', [Administrator::class, 'reject_profile']); 
        
        Route::get('/users_list', [Administrator::class, 'users_list']); 
        Route::get('/kyc_verification', [Administrator::class, 'kyc_verification']); 
        Route::get('/kyc_approved', [Administrator::class, 'kyc_approved']); 

        Route::get('/loan_approved', [Administrator::class, 'loan_approved']); 
        Route::get('/disbursal_pending', [Administrator::class, 'disbursal_pending']); 
        // Route::get('/kyc_approved', [Administrator::class, 'kyc_approved']); 
        Route::get('/enach_api', [Administrator::class, 'enach_api']); 




        // kyc_pending
        // kyc_approved
        // loan_approved
        // loan_pending
        // loan_rejected
        

        
        


        

});