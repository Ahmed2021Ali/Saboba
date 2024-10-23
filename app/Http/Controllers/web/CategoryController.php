<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with(['children.translations', 'translations'])
            ->whereNull('parent_id') // Get only main categories
            ->get();
        dd($categories);
        return view('dashboard.categories', compact('categories'));
    }

}
