<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Ticket;
use App\Models\Ticket_details;
use App\Models\Ride;
use Exception;
use Session;


class TicketController extends Controller
{   
    function __construct()
    {
        $this->middleware(['permission:ticket-index'], ['only' => ['indexticket']]);
        $this->middleware(['permission:ticket-create'], ['only' => ['createticket', 'storeticket']]);
        // $this->middleware(['permission:ticket-print'], ['only' => ['printticket']]);
        $this->middleware(['permission:ticket-delete'], ['only' => ['destroyticket']]);

    }

    public function indexticket() {
        $tickets = Ticket::with('user')->latest()->paginate(100);
        return view('backend.ticket.index', compact('tickets'));
    }
    
    public function createticket() {
        $rides = Ride::where('status', 1)->get(); // Fetch all rides
        return view('backend.ticket.create', compact('rides'));
    }
    
    public function storeticket(Request $request): RedirectResponse
    {
        // Validate the form input
        $request->validate([
            'ride' => 'required|array', // Ensure 'ride' is an array
            'ride.*' => 'exists:rides,id', // Ensure each selected ride exists in the 'rides' table
        ]);

            $ticket = new Ticket();
            $ticket->user_id = Auth::id();
            $ticket->ref_code = rand(100000, 999999) . date('is');
            $ticket->save();

            // Loop through each selected ride and create TicketDetail records
            foreach ($request->ride as $rideId) {
                $ticketDetail = new Ticket_details();
                $ticketDetail->ticket_id = $ticket->id;
                $ticketDetail->ride_id = $rideId;
                $ticketDetail->user_id = Auth::id();
                $ticketDetail->price = Ride::find($rideId)->price; // Assuming you have a price field in the Ride model
                $ticketDetail->save();
            }
            return redirect()->route('ticket.print', $ticket->id)->with('success', 'Ride created successfully.');
    }

    public function printticket($id=null){
        $ticket = Ticket::with('details')->findOrFail($id);
        $qrCode = QrCode::size(100)->generate($ticket->ref_code);
        $today = now()->format('Y-m-d');
        return view('backend.ticket.print', compact('ticket', 'qrCode', 'today'));
    }


    //delete data in database
    public function destroyticket($id=null){
        Ticket_details::where('ticket_id', $id)->delete();
        Ticket::find($id)->delete();    
        return redirect()->route('ticket.index')->with('success', 'Data Delete successfully.');
    }
}
