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
    
        $todayTiketSales = Entry::whereDate('created_at', now()->toDateString())->sum('price');
        $monthlyTiketSales = Entry::whereMonth('created_at', now()->month)
                                    ->whereYear('created_at', now()->year)
                                    ->sum('price');
        $yearlyTiketSales = Entry::whereYear('created_at', now()->year)->sum('price');

        $todayRideSales = Ticket_details::whereDate('created_at', now()->toDateString())->sum('price');
        $monthlyRideSales = Ticket_details::whereMonth('created_at', now()->month)
                                    ->whereYear('created_at', now()->year)
                                    ->sum('price');
        $yearlyRideSales = Ticket_details::whereYear('created_at', now()->year)->sum('price');


        $todayCustomers = Entry::whereDate('created_at', now()->toDateString())->count('id');
        $monthlyCustomers = Entry::whereMonth('created_at', now()->month)
                                    ->whereYear('created_at', now()->year)
                                    ->count('id');
        $yearlyCustomers = Entry::whereYear('created_at', now()->year)->count('id');


    
        return view('backend/dashboard', 
        compact('ticketDetails', 
        'todayTiketSales', 'monthlyTiketSales', 'yearlyTiketSales',
        'todayRideSales', 'monthlyRideSales', 'yearlyRideSales',
        'todayCustomers', 'monthlyCustomers', 'yearlyCustomers',
    ));
    }
    
}
