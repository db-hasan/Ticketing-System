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

        $todayRideSales = Ticket_details::whereDate('created_at', now()->toDateString())->sum('price');
        $monthlyRideSales = Ticket_details::whereMonth('created_at', now()->month)
                                    ->whereYear('created_at', now()->year)
                                    ->sum('price');

    
        return view('backend/dashboard', compact('ticketDetails', 'todayTiketSales', 'monthlyTiketSales', 'todayRideSales', 'monthlyRideSales'));
    }
    
}
