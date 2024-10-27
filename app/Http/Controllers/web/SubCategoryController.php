<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Traits\media;
use App\Models\Category;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    use media;

    public function index(category $category)
    {
        return view('dashboard.sub_categories.index', [
            'category' => $category,
            'subCategories' => $category->children
        ]);
    }

    public function store(Request $request, Category $category)
    {
        $DataValidated = $request->validate(['name' => 'required|string', 'images.*' => 'nullable|max:10000']);
        $subCategory = Category::create([...$DataValidated, 'parent_id' => $category->id]);
        $this->downloadImages($request->images, $subCategory, 'categoryImages');
        flash()->success(' Create successfully ');
        return to_route('sub_categories.index', $category);
    }

    public function update(Request $request, Category $category)
    {
        $DataValidated = $request->validate(['name' => 'nullable|string', 'images.*' => 'nullable|max:10000', 'parent_id' => 'nullable|exists:categories,id']);
        $category->update($DataValidated);
        $this->updateImages($request->images, $category, 'categoryImages');
        flash()->success(' Update successfully ');
        return to_route('sub_categories.index', $category->parent);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        flash()->success(' deleted successfully ');
        return to_route('categories.index');
    }
}
