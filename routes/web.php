<?php

use App\Mail\TestMail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\exportpdf;
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

Route::get('/', function () {
    return view('welcome');
});
 Route::get('/email',function(){
    return view('emails.TestMail');
 });
 Route::get('/pdf',function(){
    return view('myPDF');
 });

 Route::get('/generate-pdf', [exportpdf::class, 'generatePDF'])->name('generatepdf');