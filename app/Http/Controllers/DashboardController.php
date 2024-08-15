<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Ride;
use App\Models\Entry;
use App\Models\Ticket_details;
use Carbon\Carbon;


class DashboardController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:dashboard-index'], ['only' => ['dashboard']]);
    }

    public function dashboard() {
        $rideTickets = Ticket_details::latest()->paginate(15);
    
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

                            
        $todayEntrySalesByUsers = Entry::select('user_id', DB::raw('SUM(price) as total_sales'))
                                    ->with('user') // Eager load the related User model
                                    ->whereDate('created_at', Carbon::today()) // Filter by today's date
                                    ->groupBy('user_id')
                                    ->orderBy('total_sales', 'desc')
                                    ->get();

        $monthlyEntrySalesByUsers = Entry::select('user_id', DB::raw('SUM(price) as total_sales'))
                                    ->with('user') // Eager load the related User model
                                    ->whereMonth('created_at', Carbon::now()->month) // Filter by current month
                                    ->whereYear('created_at', Carbon::now()->year) // Filter by current year
                                    ->groupBy('user_id')
                                    ->orderBy('total_sales', 'desc')
                                    ->get();
        $yearlyEntrySalesByUsers = Entry::select('user_id', DB::raw('SUM(price) as total_sales'))
                                    ->with('user') // Eager load the related User model
                                    ->whereYear('created_at', Carbon::now()->year) // Filter by current year
                                    ->groupBy('user_id')
                                    ->orderBy('total_sales', 'desc')
                                    ->get();

        $todayRideSalesByUsers = Ticket_details::select('user_id', DB::raw('SUM(price) as total_sales'))
                                    ->with('user') // Eager load the related User model
                                    ->whereDate('created_at', Carbon::today()) // Filter by today's date
                                    ->groupBy('user_id')
                                    ->orderBy('total_sales', 'desc')
                                    ->get();

        $monthlyRideSalesByUsers = Ticket_details::select('user_id', DB::raw('SUM(price) as total_sales'))
                                    ->with('user') // Eager load the related User model
                                    ->whereMonth('created_at', Carbon::now()->month) // Filter by current month
                                    ->whereYear('created_at', Carbon::now()->year) // Filter by current year
                                    ->groupBy('user_id')
                                    ->orderBy('total_sales', 'desc')
                                    ->get();
        $yearlyRideSalesByUsers = Ticket_details::select('user_id', DB::raw('SUM(price) as total_sales'))
                                    ->with('user') // Eager load the related User model
                                    ->whereYear('created_at', Carbon::now()->year) // Filter by current year
                                    ->groupBy('user_id')
                                    ->orderBy('total_sales', 'desc')
                                    ->get();

    
        return view('backend/dashboard', 
        compact('rideTickets', 
        'todayTiketSales', 'monthlyTiketSales', 'yearlyTiketSales',
        'todayRideSales', 'monthlyRideSales', 'yearlyRideSales',
        'todayCustomers', 'monthlyCustomers', 'yearlyCustomers',
        'todayEntrySalesByUsers', 'monthlyEntrySalesByUsers', 'yearlyEntrySalesByUsers',
        'todayRideSalesByUsers', 'monthlyRideSalesByUsers', 'yearlyRideSalesByUsers'
    ));
    }
    
}
