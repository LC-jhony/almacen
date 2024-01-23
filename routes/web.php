<?php

use App\Http\Controllers\Loanpdf;
use Illuminate\Support\Facades\Route;
use Spatie\Browsershot\Browsershot;
use Spatie\LaravelPdf\Facades\Pdf;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     Pdf::view('welcome')->save('/some/directory/invoice.pdf');
// });
Route::get('/loan/{record}/pdf', [Loanpdf::class,'download'])->name('download.pdf');

