<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function showMaidService()
    {
        // Return the view for the maid service
        return view('maidservice'); // Ensure you have a view named `maidservice.blade.php`
    }
    public function showDeepCleaningService()
    {
        // Return the view for the deep cleaning service
        return view('deepcleaningservice'); // Ensure you have a view named `deepcleaningservice.blade.php`
    }
}
