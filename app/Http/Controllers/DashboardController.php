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
        $rideTickets = Ticket_details::latest()->paginate(10);
    
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

                            


        $todayEntrySalesByUsers = Entry::with('user') // Eager load the user
                                        ->select('user_id', DB::raw('SUM(price) as total_sales'))
                                        ->whereDate('created_at', Carbon::today())
                                        ->groupBy('user_id')
                                        ->orderBy('total_sales', 'desc')
                                        ->get();

        $todayRideSalesByUsers = Ticket_details::with('user') // Eager load the user
                                            ->select('user_id', DB::raw('SUM(price) as total_sales'))
                                            ->whereDate('created_at', Carbon::today())
                                            ->groupBy('user_id')
                                            ->orderBy('total_sales', 'desc')
                                            ->get();


        // Define default price if no sales found
        $defaultPrice = 0.0;

        // Collect all unique user IDs from both sales collections
        $userIds = $todayEntrySalesByUsers->pluck('user_id')->merge($todayRideSalesByUsers->pluck('user_id'))->unique();

        $todadyUserSale = collect();

        foreach ($userIds as $userId) {
            $entrySale = $todayEntrySalesByUsers->firstWhere('user_id', $userId);
            $totalEntrySales = $entrySale ? $entrySale->total_sales : $defaultPrice;
            $userName = $entrySale ? $entrySale->user->name : 'Unknown';

            $rideSale = $todayRideSalesByUsers->firstWhere('user_id', $userId);
            $totalRideSales = $rideSale ? $rideSale->total_sales : $defaultPrice;

            if ($rideSale && $rideSale->user->name) {
                $userName = $rideSale->user->name;
            }

            $totalSales = $totalEntrySales + $totalRideSales;

            $todadyUserSale->push([
                'user_id' => $userId,
                'user_name' => $userName,
                'total_sales' => $totalSales,
            ]);
        }

        $todadyUserSale = $todadyUserSale->sortByDesc('total_sales');


    

        return view('backend/dashboard', 
        compact('rideTickets', 
        'todayTiketSales', 'monthlyTiketSales', 'yearlyTiketSales',
        'todayRideSales', 'monthlyRideSales', 'yearlyRideSales',
        'todayCustomers', 'monthlyCustomers', 'yearlyCustomers',
        // 'todayEntrySalesByUsers', 'monthlyEntrySalesByUsers', 'yearlyEntrySalesByUsers',
        // 'todayRideSalesByUsers', 'monthlyRideSalesByUsers', 'yearlyRideSalesByUsers',
        'todayEntrySalesByUsers', 'todayRideSalesByUsers', 'todadyUserSale'
    ));
    }
    
}
