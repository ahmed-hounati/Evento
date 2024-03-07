<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
            return view('admin.categories.all', ['categories' => $categories]);
    }
    public function create()
    {
        return view('admin.categories.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:categories,name'],
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->save();

            return redirect()->route('categories.all')->with('success', 'Category created successfully!');
    }
    public function edit($id)
    {
        $category = Category::findOrFail($id);
            return view('admin.categories.update', ['category' => $category]);
    }
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $request->validate([
            'name' => ['required', 'unique:categories,name'],
        ]);
        $category->name = $request->name;
        $category->save();
            return redirect()->route('categories.all')->with('success', 'Category updated successfully!');
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
            return redirect()->route('categories.all')->with('success', 'Category deleted successfully!');
    }
}
