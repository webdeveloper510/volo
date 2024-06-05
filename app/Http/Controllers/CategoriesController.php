<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function index()
    {
        $allCategory = Category::all();
        return view('category.index', compact('allCategory'));
    }

    public function createCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'categoryName' => 'required|string|max:255|unique:categories,name',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'The category name has already been taken.'
            ]);
        }

        $category = new Category();
        $category->name = $request->categoryName;

        if ($category->save()) {
            return response()->json([
                'status' => 200,
                'category' => $category,
                'message' => 'Category created successfully!'
            ]);
        } 
    }
}
