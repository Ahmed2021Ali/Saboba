<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Traits\media;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use media;

    public function index(Request $request)
    {
        $categories = Category::with('translations')->whereNull('parent_id')->paginate(8);
        return view('dashboard.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $DataValidated = $request->validate(['name' => 'required|string']);
        Category::create($DataValidated);
        return to_route('categories.index');
    }

}
