<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use App\Models\Price;
use Exception;
use Session;

class PriceController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:price-index'], ['only' => ['indexprice']]);
        $this->middleware(['permission:price-edit'], ['only' => ['editprice', 'updateprice']]);

    }

    public function indexprice() {
        $prices = Price::latest()->get();
        return view('backend.price.index',compact('prices'));
    }
    

    public function editprice($id=null){
        $prices['price'] = Price::find($id);
        if (!$prices['price']) {
            return redirect()->back();
        }     
        return view('backend/price/edit', $prices);
    }

    public function updateprice(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
        ]);
        
        try {
            $data = Price::findOrFail($id);
            $data->name   = $request->input('name');
            $data->price  = $request->input('price');
            $data->save();

                return redirect()->route('price.index')->with('success', 'Data update successfully.');
            } catch (\Exception $e) {
                return redirect()->route('price.index')->with('error', $e->getMessage());
        }
    }
}
