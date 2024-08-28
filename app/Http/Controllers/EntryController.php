<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
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
        $this->middleware(['permission:entry-print'], ['only' => ['entryticket']]);

    }

    public function indexentry() {
        $entries = Entry::with('user')->orderBy('id', 'desc')->paginate(50);
        return view('backend.entry.index', compact('entries'));
    }
    

    public function entrysearch(Request $request){

        $entrysearch = Entry::where('ref_code', 'like', '%' . $request->search . '%')
                            ->orWhere('number', 'like', '%' . $request->search . '%')
                            ->get();
        
        $output = '';

        foreach ($entrysearch as $item) {
            $statusText = $item->status == 1 ? 'Active' : ($item->status == 2 ? 'Inactive' : '');

            $output .=
            '<tr>
                <td>' .$item->id. '</td>
                <td>' .$item->user->name. '</td>
                <td>' .$item->prices->name. '</td>
                <td>' .$item->ref_code. '</td>
                <td>' .$item->number. '</td>
                <td>' .$item->price. '</td>
                <td>' .$item->created_at. '</td>
                <td>' .$statusText. '</td>
                <td class="d-flex justify-content-end">
                    <a href="' . route('entry.print', $item->id) . '" class="btn btn-primary mx-1"><i class="bi bi-printer"></i></a>
                </td>
            </tr>';
        }

        return response($output);
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
        try{
            $price = Price::find($request->price_id); // Retrieve the price based on price_id

            $entry = new Entry();
            $entry->user_id = Auth::id();
            $entry->ref_code = rand(100000, 999999) . date('is');
            $entry->number = $request->number;
            $entry->price_id = $request->price_id;
            $entry->price = $price->price;
            $entry->save();
            return redirect()->route('entry.print', $entry->id)->with('success', 'Entry created successfully.');
        } catch (Exception $e) {
            return redirect()->route('entry.index')->with('error', 'An error occurred. Please try again.');
        }
    }

    public function printentry($id=null){
        $entry = Entry::findOrFail($id);
        $qrCode = base64_encode(QrCode::format('png')->size(100)->generate($entry->ref_code));
        $today = now()->format('Y-m-d');

        return view('backend.entry.print', compact('entry', 'qrCode', 'today'));
    }
}
