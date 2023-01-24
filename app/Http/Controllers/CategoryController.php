<?php

namespace App\Http\Controllers;

use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return Inertia::render('Category/Category', [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        return Inertia::render('Category/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_name' => [
                'required',
                'max:100',
                'min:3',
                'unique:categories,category_name'
            ],
            'duration' => [
                'required',
                'integer'
            ],
            'description' => [
                'required',
                'min:5',
                'max:255'
            ],
            'price' => [
                'required'
            ]
        ]);

        Category::create([
            'category_name' => $request->category_name,
            'duration' => $request->duration,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return Redirect::route('category.index')->with('success', $request->category_name . ' category created successfully!');
    }

    public function edit($id)
    {
        $category = Category::find($id);

        return Inertia::render('Category/Edit', [
            'category' => $category
        ]);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        $validated = $request->validate([
            'category_name' => [
                'required',
                'max:100',
                'min:3',
                Rule::unique('categories')->ignore($category)
            ],
            'duration' => [
                'required',
                'integer'
            ],
            'description' => [
                'required',
                'min:5',
                'max:255'
            ],
            'price' => [
                'required'
            ]
        ]);

        $category->category_name = $request->category_name;
        $category->duration = $request->duration;
        $category->description = $request->description;
        $category->price = $request->price;
        $category->save();

        return Redirect::route('category.index')->with('success', $request->category_name . ' category updated successfully!');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return Redirect::route('category.index')->with('success', $category->category_name . ' deleted successfully!');
    }
}