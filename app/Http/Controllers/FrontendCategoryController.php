<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class FrontendCategoryController extends Controller
{
    public function viewCategory()
    {
        $category_items = Category::all();

        return view('home.index', compact('category_items'));
    }

}
