<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use Spatie\LaravelPdf\Enums\Format;
use Spatie\LaravelPdf\Facades\Pdf;
use Spatie\Browsershot\Browsershot;

class Loanpdf extends Controller
{
    public function download(Loan $loan)
    {
    
        //$loans::whereKey($this->loans->pluck('id')->get());
        return view('filament.pages.pdf.loan');

      
    }
}
