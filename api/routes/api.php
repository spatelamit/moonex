<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/send_otp', [Users::class, 'send_otp']); 
Route::post('/verify_otp', [Users::class, 'verify_otp']); 

Route::group([
    'middleware' => 'auth:api'
], function ($router) {


Route::get('/get_user', [Users::class, 'get_user']); 

Route::post('/personal_data', [Users::class, 'update_user_profile']); 
Route::post('/pan_data', [Users::class, 'update_user_profile']); 
Route::post('/employment_data', [Users::class, 'update_user_profile']); 
Route::post('/bank_data', [Users::class, 'update_user_profile']); 
Route::post('/document_upload', [Users::class, 'update_user_profile']); 
Route::post('/save_enach_response', [Users::class, 'save_enach_response']); 

Route::post('/logout', [Users::class, 'logout']); 

// Route::post('/set_username_password', [Users::class, 'set_username_password']); 
// Route::post('/set_password', [Users::class, 'set_password']); 




});




