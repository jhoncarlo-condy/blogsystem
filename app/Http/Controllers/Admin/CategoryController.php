<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Events\AddCategoryEvent;
use Illuminate\Http\Request;
use App\Events\AddCountEvent;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::select(
            'id',
            'title',
            'description',
            'blogmax')
            ->orderby('id','desc')->paginate(5);
        return view('admin.category')->with([
            'categories'=> $categories
        ]);
    }
    public function realtimecategory()
    {
        $categories = Category::select(
            'id',
            'title',
            'description',
            'blogmax')
            ->orderby('id','desc')->paginate(5);
        return view('admin.realtimecategory')->with([
            'categories'=>$categories
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|unique:categories',
            'description' => 'required',
            'blogmax'=>'required'
        ]);
        $category = Category::create($data);
        $categorycount = count($category);
        event (new AddCategoryEvent($categorycount));
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
        $post = $category->post()->doesntExist();
      if ($post) {
        $category->delete();
        return back()->with(['message'=>'Category Deleted Successfully']);
      }
      else {
        return back()->with(['error'=>'Delete post first with the selected category']);
      }
    }
}
