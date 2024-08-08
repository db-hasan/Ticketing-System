<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;
use App\Models\Ride;
use Exception;
use Session;


class TicketController extends Controller
{
    public function indexticket() {
        return view('backend.ticket.index');
    }
    
    public function createticket() {
        $rides = Ride::all(); // Fetch all rides
        return view('backend.ticket.create', compact('rides'));
    }
    
    public function storeticket(Request $request):RedirectResponse
    {
        $request->validate([
            'number' => 'required',

            'ticket_details' => 'required|array', // Validate that ticket_details is an array
            'ticket_details.*.name' => 'required|string',
            'ticket_details.*.price' => 'required|string',
        ]);

            $data = new Ticket();
            $data->user_id = Auth::id();
            $data->ref_code = rand(100000, 999999) . date('is');
            $data->number = $request->number;
            $data->save();

            foreach ($request->ticket_details as $detail) {
                $ticketDetail = new Ticket_details();
                $ticketDetail->ticket_id = $data->id; // Set the foreign key to the newly created Ticket's ID
                $ticketDetail->ride_id = $detail['ride_id']; // Make sure to include ride_id if needed
                $ticketDetail->name = $detail['name'];
                $ticketDetail->price = $detail['price'];
                $ticketDetail->save();
            }

            return redirect()->route('ticket.index')->with('success', 'Ticket created successfully.');
        }

        // try {
        //     $data = new Ticket();
        //     $data->user_id = Auth::id();
        //     $data->ref_code = rand(100000, 999999) . date('is');
        //     $data->number = $request->number;
        //     $data->save();
        //     return redirect()->route('ticket.index')->with('success', 'Ticket created successfully.');
        // } catch (\Exception $e) {
        //     return redirect()->route('ticket.index')->with('error', 'An error occurred. Please try again.');
        // }


    public function editticket($id=null){
        $tickets['ticket'] = ticket::find($id);
        if (!$tickets['ticket']) {
            return redirect()->back();
        }     
        return view('backend/ticket/edit', $tickets);
    }

    public function updateticket(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'status' => 'required',
        ]);
        
        try {
            $data = ticket::findOrFail($id);
            $data->name   = $request->input('name');
            $data->price  = $request->input('price');
            $data->status  = $request->input('status');
            $data->save();

                return redirect()->route('ticket.index')->with('success', 'Data update successfully.');
            } catch (\Exception $e) {
                return redirect()->route('ticket.index')->with('error', $e->getMessage());
        }
    }

    //delete data in database
    public function destroyticket($id=null){
        $destroyData = ticket::find($id);
        $destroyData->delete();
        return redirect()->route('ticket.index')->with('success', 'Data Delete successfully.');
    }
}
