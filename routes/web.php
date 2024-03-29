<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

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

// Route::get('/', function () {
//     return view('students_data');
// });
Route::get('/',[StudentController::class,'show']);
Route::get('search',[StudentController::class,'search']);

Route::get('/whatsapp_form',[StudentController::class,'form']);

Route::get('/student_new_form',[StudentController::class,'emailForm']);

Route::get('/message_send_form',[StudentController::class,'messageSendform']);
Route::post('message_send_form_store',[StudentController::class,'messagestore']);

Route::view('students_data','students_data');
Route::view('form','student_form');
Route::post('store',[StudentController::class,'store']);
//Route::view('students_data','students_Data');

Route::get('delete/{id}',[StudentController::class,'destroy']);
Route::get('edit/{id}',[StudentController::class,'edit']);
Route::post('update/{id}',[StudentController::class,'update']);


Route::get('wapping/send',[StudentController::class,'send']);
//Route::get('wapping/send','StudentController@send');

Route::get('/loops',[StudentController::class,'loops']);
