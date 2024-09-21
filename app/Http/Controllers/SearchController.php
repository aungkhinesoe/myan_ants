<?php

namespace App\Http\Controllers;

use App\Models\Service; 
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
    
        // Search for services based on the title
        $services = Service::where('title', 'LIKE', "%{$query}%")->get();
    
        return view('home.search_results', compact('services')); // Updated to reflect the correct path
    }
}    
