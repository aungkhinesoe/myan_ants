<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;
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
    public function add_service()
    {
        $categories = Category::all();

        return view('admin.add_service' ,compact('categories'));
    }

    public function upload_service(Request $request)
    {
        $service = new Service;

        $service->title = $request->title;
        $service->description = $request->description;
        $service->price = $request->price;
        $service->category = $request->category;

        $image = $request->image;
        if($image)
        {
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('services',$imagename);
            $service->image = $imagename;
        }

        $service->save();

        return redirect()->back();
    }

    public function view_service()
    {
        $services = Service::all();
        return view('admin.view_service' ,compact('services'));
    }

    public function delete_service($id)
    {
        $service_item = Service::find($id);

        $image_path = public_path('services/'.$service_item->image);
        if(file_exists($image_path))
        {
            unlink($image_path);
        }

        $service_item->delete();

        return redirect()->back();
    }
}
