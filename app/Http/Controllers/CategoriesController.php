<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function index()
    {
        $allCategory = Category::where('is_deleted', 0)->get();
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

    public function updateCategory(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
        ]);

        $category = Category::find($request->id);
        $category->name = $request->name;
        $category->save();

        return redirect()->back()->with('success', 'Category updated successfully.');
    }

    public function destroyCategory(Request $request)
    {
        $category = Category::find($request->id);

        if ($category) {
            $category->is_deleted = 1;
            $category->save();
            return response()->json(['success' => 'Category marked as deleted successfully.']);
        }

        return response()->json(['error' => 'Category not found.'], 404);
    }
}
