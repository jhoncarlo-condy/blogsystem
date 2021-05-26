<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Category;
use App\Post;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::select(
            'id',
            'title',
            'description',
            'blogmax')->paginate(5);
        return view('admin.category')->with([
            'categories'=> $categories
        ]);
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|unique:categories',
            'description' => 'required',
            'blogmax'=>'required'
        ]);
        Category::create($data);
        return back()->with(['message'=>'Added new category']);
    }
    public function edit(Category $category)
    {
        return view('category.index')->with([
            'category'=>$category
        ]);
    }
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',

        ]);
        $category->update($data);
        return back()->with(['message' => 'Success updating category']);

    }
    public function destroy(Category $category)
    {
        $post = $category->posts()->doesntExist();
      if ($post == true) {
            $category->delete();
            return back()->with(['message'=>'Category Deleted Successfully']);
      }
      else {
          return redirect()->back()->with(['error'=>'Delete post first with the selected category']);
      }
    }
}
