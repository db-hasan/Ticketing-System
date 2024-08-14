<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ride;
use App\Models\Entry;
use App\Models\Ticket_details;

class DashboardController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:dashboard-index'], ['only' => ['dashboard']]);
    }

    public function dashboard() {
        $ticketDetails = Ticket_details::latest()->paginate(20);
    
        $todaySales = Ticket_details::whereDate('created_at', now()->toDateString())->sum('price');
        $monthlySales = Ticket_details::whereMonth('created_at', now()->month)
                                    ->whereYear('created_at', now()->year)
                                    ->sum('price');
        $todayCustomers = Entry::whereDate('created_at', now()->toDateString())->count('id');
        $monthlyCustomers = Entry::whereMonth('created_at', now()->month)
                                    ->whereYear('created_at', now()->year)
                                    ->count('id');
        $yearlyCustomers = Entry::whereYear('created_at', now()->year)->count('id');
    
        return view('backend/dashboard', compact('ticketDetails', 'todaySales', 'monthlySales', 'todayCustomers', 'monthlyCustomers', 'yearlyCustomers'));
    }
    
}
