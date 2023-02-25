<?php

use App\Http\Controllers\ApplicantController;
use Illuminate\Support\Facades\Route;

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

Route::get('/',[ApplicantController::class,'index'])->name('index');
Route::get('/form',[ApplicantController::class,'index2'])->name('index2');
Route::any('/find-email',[ApplicantController::class,'getPage'])->name('find-email');
Route::post('store-applicant',[ApplicantController::class,'store'])->name('store-applicant');
Route::get('/fetch-app1',[ApplicantController::class,'getAppData'])->name('fetch-app1');
Route::get('/fetch-emaillist',[ApplicantController::class,'getEmailListData'])->name('fetch-emaillist');
Route::get('/slide2',[ApplicantController::class,'slide2'])->name('slide2');
Route::get('/thank-you',[ApplicantController::class,'thankYou'])->name('thank-you');
