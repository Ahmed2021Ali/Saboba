<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::with('translations')->whereNull('parent_id')->paginate(8);
        return view('dashboard.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $categories = Category::with('translations')->whereNull('parent_id')->paginate(8);
        return view('dashboard.categories.index', compact('categories'));
    }

}
