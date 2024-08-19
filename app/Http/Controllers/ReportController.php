<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Ride;


class ReportController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:index-report'], ['only' => ['indexreport']]);
        $this->middleware(['permission:sales-report'], ['only' => ['salesreport']]);
        $this->middleware(['permission:seller-report'], ['only' => ['sellerreport']]);
    }
    
    public function indexreport() {
        return view('backend/report.index');
    }

    public function salesinvoice() {
        return view('backend/report.salesreport');
    }
    public function salesreport( Request $request) {

        
        $request->validate([
            'formsalesdate' => 'required|date|before_or_equal:tosalesdate',
            'tosalesdate' => 'required|date',
        ],[
            'formsalesdate.before_or_equal' => 'The Form Date field must be a date before or equal to the To Date field.',
        ]);

        dd($request);


        return view('backend/report.salesreport');
    }

    public function sellerinvoice() {
        return view('backend/report.sellerreport');
    }
    public function sellerreport() {
        return view('backend/report.sellerreport');
    }
}
