<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use App\Models\Price;
use App\Models\Entry;
use App\Models\Ticket_details;


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

    public function salesreport(Request $request) {
        $request->validate([
            'formsalesdate' => 'required|date|before_or_equal:tosalesdate',
            'tosalesdate' => 'required|date',
        ], [
            'formsalesdate.before_or_equal' => 'The Form Date field must be a date before or equal to the To Date field.',
        ]);
    
        $from = $request->input('formsalesdate');
        $to = $request->input('tosalesdate');
    
        $queryEntries = Entry::query()
            ->with(['prices']) 
            ->whereDate('created_at', '>=', $from)
            ->whereDate('created_at', '<=', $to)
            ->get();
    
        $groupedEntries = $queryEntries->groupBy(function ($entry) {
            return $entry->prices->name;
        });
    
        $ticketQTY = $groupedEntries->map->count();
        $ticketPrice = $groupedEntries->map->sum('price');
    
        $queryRides = Ticket_details::query()
            ->with(['ride']) 
            ->whereDate('created_at', '>=', $from)
            ->whereDate('created_at', '<=', $to)
            ->get();
    
        $groupedRides = $queryRides->groupBy(function ($ride) {
            return $ride->ride->name;
        });
    
        $ridesQTY = $groupedRides->map->count();
        $ridesPrice = $groupedRides->map->sum('price');
    
        // Merge and align data
        $mergedData = $groupedEntries->mergeRecursive($groupedRides);
    
        $mergedQTY = $ticketQTY->merge($ridesQTY);
        $mergedPrice = $ticketPrice->merge($ridesPrice);
    
        // Cache date filters
        Cache::put('from', $from);
        Cache::put('to', $to);

        $today = now()->format('Y-m-d'); // Format as needed, e.g., 'Y-m-d', 'd-m-Y'

    
        return view('backend/report.salesreport', 
            compact('from', 'to', 'today',
            'mergedData', 'mergedQTY', 'mergedPrice',));
    }

    public function sellerinvoice() {
        return view('backend/report.sellerreport');
    }



    public function sellerreport(Request $request) {
        $request->validate([
            'formsellerdate' => 'required|date|before_or_equal:tosellerdate',
            'tosellerdate' => 'required|date',
        ], [
            'formsellerdate.before_or_equal' => 'The Form Date field must be a date before or equal to the To Date field.',
        ]);

        $from = $request->input('formsellerdate');
        $to = $request->input('tosellerdate');

        // Query and group Entry
        $queryEntries = Entry::query()
            ->with(['user', 'prices'])
            ->whereDate('created_at', '>=', $from)
            ->whereDate('created_at', '<=', $to)
            ->get();

        $entryData = $queryEntries->groupBy('user_id')->map(function ($userEntries) {
            return $userEntries->groupBy('price_id')->map(function ($priceEntries) {
                return [
                    't_name' => $priceEntries->first()->prices->name,
                    't_quantity' => $priceEntries->count(),
                    't_amount' => $priceEntries->sum('price'),
                ];
            });
        });

        $queryRides = Ticket_details::query()
            ->with(['user', 'ride'])
            ->whereDate('created_at', '>=', $from)
            ->whereDate('created_at', '<=', $to)
            ->get();

        // Group by user and ride to calculate totals
        $rideData = $queryRides->groupBy('user_id')->map(function ($userRides) {
            return $userRides->groupBy('ride_id')->map(function ($rideDetails) {
                return [
                    'r_name' => $rideDetails->first()->ride->name,
                    'r_quantity' => $rideDetails->count(),
                    'r_amount' => $rideDetails->sum('price'),
                ];
            });
        });


        // In your controller, after calculating $entryData and $rideData
        $mergedData = $entryData->map(function ($entry, $userId) use ($rideData) {
            return $entry->merge($rideData->get($userId, collect()));
        });


        
        // Cache date filters
        Cache::put('from', $from);
        Cache::put('to', $to);

        $today = now()->format('Y-m-d');

        return view('backend.report.sellerreport', 
        compact('from', 'to', 'today', 'mergedData'));
    }

}
