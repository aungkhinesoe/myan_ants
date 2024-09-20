<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }
    public function home()
    {
        $category_items = Category::All();

        return view('home.index', compact('category_items'));
    }
}
