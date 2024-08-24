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


}
