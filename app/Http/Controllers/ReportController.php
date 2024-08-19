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

    public function salesreport() {
        return view('backend/report.salesreport');
    }

    public function sellerreport() {
        return view('backend/report.sellerreport');
    }
}
