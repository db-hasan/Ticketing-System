<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function indexreport() {
        return view('backend/report.index');
    }
}
