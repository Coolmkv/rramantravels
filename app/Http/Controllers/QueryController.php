<?php

namespace App\Http\Controllers;
use App\Models\Query;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class QueryController extends Controller
{
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string',
        ]);

        // Save to database
        $query = Query::create($validated);

        // Optional: Send email notification
        /*
        Mail::to('your-email@example.com')->send(new \App\Mail\QueryReceived($query));
        */

        return response()->json([
            'success' => true,
            'message' => 'Query submitted successfully'
        ]);
    }
}