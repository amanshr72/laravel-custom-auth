<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class QuoteController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function getQuotes()
    {
        $response = Http::get('https://api.kanye.rest/quotes', [
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);

        if (!$response->successful()) {
            return response()->json(['error' => 'Failed to fetch quote'], $response->status());
        }
        
        return $response->json();
    }
}
