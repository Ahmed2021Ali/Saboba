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
        $DataValidated = $request->validate(['name' => 'required|string', 'images.*' => 'nullable|max:10000']);
        $category = Category::create($DataValidated);
        $this->downloadImages($request->images, $category, 'categoryImages');
        flash()->success(' Create successfully ');
        return to_route('categories.index');
    }
    public function show(Category $category)
    {
      //  return view('dashboard.categories.sub_categories', ['categories'=>$category->children]);
    }

    public function update(Request $request, Category $category)
    {
        $DataValidated = $request->validate(['name' => 'nullable|string', 'images.*' => 'nullable|max:10000']);
        $category->update($DataValidated);
        $this->updateImages($request->images, $category , 'categoryImages');
        flash()->success(' Update successfully ');
        return to_route('categories.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        flash()->success(' deleted successfully ');
        return to_route('categories.index');
    }

}
