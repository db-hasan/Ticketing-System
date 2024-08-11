<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;
use App\Models\Ticket_details;
use App\Models\Ride;
use Exception;
use Session;


class TicketController extends Controller
{
    public function indexticket() {
        $tickets = Ticket::latest()->paginate(100);
        return view('backend.ticket.index', compact('tickets'));
    }
    
    public function createticket() {
        $rides = Ride::all(); // Fetch all rides
        return view('backend.ticket.create', compact('rides'));
    }
    
    public function storeticket(Request $request): RedirectResponse
    {
        // Validate the form input
        $request->validate([
            'number' => 'required',
            'ride' => 'required|array', // Ensure 'ride' is an array
            'ride.*' => 'exists:rides,id', // Ensure each selected ride exists in the 'rides' table
        ]);

        // Create the ticket
        try{
            $ticket = new Ticket();
            $ticket->user_id = Auth::id();
            $ticket->ref_code = rand(100000, 999999) . date('is');
            $ticket->number = $request->number;
            $ticket->save();

            // Loop through each selected ride and create TicketDetail records
            foreach ($request->ride as $rideId) {
                $ticketDetail = new Ticket_details();
                $ticketDetail->ticket_id = $ticket->id;
                $ticketDetail->ride_id = $rideId;
                $ticketDetail->price = Ride::find($rideId)->price; // Assuming you have a price field in the Ride model
                $ticketDetail->save();
            }
            return redirect()->route('ticket.index')->with('success', 'Ticket created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('ticket.index')->with('error', 'An error occurred. Please try again.');
        }
    }


    public function editticket($id=null){
        $tickets['ticket'] = Ticket::find($id);
        $tickets['rides'] = Ride::all(); // Fetch all rides
        if (!$tickets['ticket']) {
            return redirect()->back();
        }     
        return view('backend/ticket/edit', $tickets);
    }

    public function updateticket(Request $request, $id): RedirectResponse
    {
        // Validate the form input
        $request->validate([
            'number' => 'required',
            'ride' => 'required|array', // Ensure 'ride' is an array
            'ride.*' => 'exists:rides,id', // Ensure each selected ride exists in the 'rides' table
        ]);

        // Find the ticket by ID
        try{
            $ticket = Ticket::findOrFail($id);
            $ticket->number = $request->number;
            $ticket->save();

            // Remove existing ticket details
            $ticket->details()->delete();

            // Create new ticket details for each selected ride
            foreach ($request->ride as $rideId) {
                $ticketDetail = new Ticket_details();
                $ticketDetail->ticket_id = $ticket->id;
                $ticketDetail->ride_id = $rideId;
                $ticketDetail->price = Ride::find($rideId)->price; // Assuming you have a price field in the Ride model
                $ticketDetail->save();
            }

            return redirect()->route('ticket.index')->with('success', 'Ticket updated successfully.');
        }catch (\Exception $e) {
            return redirect()->route('ticket.index')->with('error', 'An error occurred. Please try again.');
        }
    }


    //delete data in database
    public function destroyticket($id=null){
        Ticket_details::where('ticket_id', $id)->delete();
        Ticket::find($id)->delete();    
        return redirect()->route('ticket.index')->with('success', 'Data Delete successfully.');
    }
}
