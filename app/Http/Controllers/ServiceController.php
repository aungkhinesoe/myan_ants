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
        $services = Service::where('category', 'Maid Services')->get();
        return view('home.maidservice', compact('services'));
    }

    // Show Deep Cleaning Services
    public function showDeepCleaningService()
    {
        $services = Service::where('category', 'Deep Cleaning Services')->get();
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

        if ($request->hasFile('image'))
        {
            $image = $request->image;
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

    // Edit service method
    public function edit_service($id)
    {
        // Fetch the service by ID
        $service = Service::find($id);
        $categories = Category::all();

        // Return the edit_service view with the service and categories data
        return view('admin.edit_service', compact('service', 'categories'));
    }

    // Update service method
    public function update_service(Request $request, $id)
    {
        // Fetch the service by ID
        $service = Service::find($id);

        // Update service details
        $service->title = $request->title;
        $service->description = $request->description;
        $service->price = $request->price;
        $service->category = $request->category;

        // Check if a new image is uploaded
        if ($request->hasFile('image'))
        {
            // Delete the old image
            $old_image_path = public_path('services/'.$service->image);
            if (file_exists($old_image_path))
            {
                unlink($old_image_path);
            }

            // Upload new image
            $image = $request->image;
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('services', $imagename);
            $service->image = $imagename;
        }

        // Save the updated service
        $service->save();

        // Redirect to the view_service page
        return redirect()->route('view_service');
    }
}
