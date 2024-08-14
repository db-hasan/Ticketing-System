<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Entry;
use App\Models\Price;
use Exception;
use Session;

class EntryController extends Controller
{   
    function __construct()
    {
        $this->middleware(['permission:entry-index'], ['only' => ['indexentry']]);
        $this->middleware(['permission:entry-create'], ['only' => ['createentry', 'storeentry']]);

    }
    


    public function indexentry() {
        $entrys = Entry::with('user')->latest()->paginate(100);
        return view('backend.entry.index', compact('entrys'));
    }
    
    public function createentry() {
        $prices = Price::all();
        return view('backend.entry.create', compact('prices'));
    }
    
    public function storeentry(Request $request): RedirectResponse
    {
        $request->validate([
            'number' => 'required',
            'price_id' => 'required|exists:prices,id', // Ensure that the price_id is valid
        ]);

        $price = Price::find($request->price_id); // Retrieve the price based on price_id

        $entry = new Entry();
        $entry->user_id = Auth::id();
        $entry->ref_code = rand(100000, 999999) . date('is');
        $entry->number = $request->number;
        $entry->price_id = $request->price_id;
        $entry->price = $price->price;
        $entry->save();

        return redirect()->back()->with('success', 'Entry created successfully.');
    }
}
