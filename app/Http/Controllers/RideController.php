<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use App\Models\Ride;
use Exception;
use Session;

class RideController extends Controller
{
    public function indexride() {
        $rides = Ride::latest()->get();
        return view('backend.ride.index',compact('rides'));
    }
    
    public function createride() {
        return view('backend.ride.create');
    }
    public function storeride(Request $request):RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
        ]);

        try {
            $data = new Ride();
            $data->name = $request->name;
            $data->price = $request->price;
            $data->save();
            return redirect()->route('ride.index')->with('success', 'Ride created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('ride.index')->with('error', 'An error occurred. Please try again.');
        }
    }

    public function editride($id=null){
        $rides['ride'] = Ride::find($id);
        if (!$rides['ride']) {
            return redirect()->back();
        }     
        return view('backend/ride/edit', $rides);
    }

    public function updateride(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'status' => 'required',
        ]);
        
        try {
            $data = Ride::findOrFail($id);
            $data->name   = $request->input('name');
            $data->price  = $request->input('price');
            $data->status  = $request->input('status');
            $data->save();

                return redirect()->route('ride.index')->with('success', 'Data update successfully.');
            } catch (\Exception $e) {
                return redirect()->route('ride.index')->with('error', $e->getMessage());
        }
    }

    //delete data in database
    public function destroyride($id=null){
        $destroyData = Ride::find($id);
        $destroyData->delete();
        return redirect()->route('ride.index')->with('success', 'Data Delete successfully.');
    }

}
