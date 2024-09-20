<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // Show Maid Services
    public function showMaidService()
    {
        // Fetch services where category is 'Maid Services'
        $services = Service::where('category', 'Maid Services')->get();

        // Return the maidservice view with the services data
        return view('home.maidservice', compact('services'));
    }

    // Show Deep Cleaning Services
    public function showDeepCleaningService()
    {
        // Fetch services where category is 'Deep Cleaning'
        $services = Service::where('category', 'Deep Cleaning')->get();

        // Return the deepcleaningservice view with the services data
        return view('home.deepcleaningservice', compact('services'));
    }

    // Add service method
    public function add_service()
    {
        $categories = Category::all();
        return view('admin.add_service', compact('categories'));
    }

    // Upload service method
    public function upload_service(Request $request)
    {
        $service = new Service;

        $service->title = $request->title;
        $service->description = $request->description;
        $service->price = $request->price;
        $service->category = $request->category;

        $image = $request->image;
        if ($image)
        {
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('services', $imagename);
            $service->image = $imagename;
        }

        $service->save();

        return redirect()->back();
    }

    // View all services method
    public function view_service()
    {
        $services = Service::all();
        return view('admin.view_service', compact('services'));
    }

    // Delete service method
    public function delete_service($id)
    {
        $service_item = Service::find($id);

        $image_path = public_path('services/'.$service_item->image);
        if (file_exists($image_path))
        {
            unlink($image_path);
        }

        $service_item->delete();

        return redirect()->back();
    }
}
