<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Entry;
use Carbon\Carbon;

class QrcodematchController extends Controller
{
    public function qrcodematch(){
        $response = Http::get('https://jsonplaceholder.typicode.com/todos/11');
        $jsonData = $response->json();

        if (empty($jsonData)) {
            return response()->json(['message' => 'Try Again Later'], 400);
        }

        $id = $jsonData['id'];


        $entry = Entry::where('ref_code', $id)->first();

        if ($entry) {
            // Check ticket status
            if ($entry->status == 2) {
                return response()->json(['message' => 'Ticket Already Used'], 400);

            } else {
                // Update the status when match
                $entry->status = 2;
                $entry->save();
                return response()->json(['message' => 'Ticket matched successfully'], 200);
            }
        } else {
            return response()->json(['message' => 'Ticket not found'], 404);
        }
    }



    // public function qrcodematch()
    // {
    //     // Step 1: Get data from the external API
    //     $response = Http::get('https://jsonplaceholder.typicode.com/todos/11');
    //     $jsonData = $response->json();

    //     if (empty($jsonData)) {
    //         // Send the 'Try Again Later' message to the API and return the response
    //         $response = Http::post('https://jsonplaceholder.typicode.com/todos', [
    //             'message' => 'Try Again Later',
    //             'status' => 400
    //         ]);
    //         return response()->json(['message' => 'Try Again Later'], 400);
    //     }

    //     $id = $jsonData['id'];

    //     // Step 2: Find the matching entry in your database
    //     $entry = Entry::where('ref_code', $id)->first();

    //     if ($entry) {
    //         // Check ticket status
    //         if ($entry->status == 2) {
    //             // Send the 'Ticket Already Used' message to the API and return the response
    //             $response = Http::post('https://jsonplaceholder.typicode.com/todos', [
    //                 'message' => 'Ticket Already Used',
    //                 'status' => 400
    //             ]);
    //             return response()->json(['message' => 'Ticket Already Used'], 400);
    //         } else {
    //             // Update the status when matched
    //             $entry->status = 2;
    //             $entry->save();

    //             // Send the 'Ticket matched successfully' message to the API and return the response
    //             $response = Http::post('https://jsonplaceholder.typicode.com/todos', [
    //                 'message' => 'Ticket matched successfully',
    //                 'entry_id' => $entry->id,
    //                 'status' => 200
    //             ]);
    //             return response()->json(['message' => 'Ticket matched successfully'], 200);
    //         }
    //     } else {
    //         // Send the 'Ticket not found' message to the API and return the response
    //         $response = Http::post('https://jsonplaceholder.typicode.com/todos', [
    //             'message' => 'Ticket not found',
    //             'status' => 404
    //         ]);
    //         return response()->json(['message' => 'Ticket not found'], 404);
    //     }
    // }


}
