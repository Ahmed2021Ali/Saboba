<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with(['children.translations', 'translations'])
            ->whereNull('parent_id')->paginate(8);
        return view('dashboard.categories.index', compact('categories'));
    }

}
