<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Category;
use Illuminate\Http\Request;
use App\Events\AddCountEvent;
use App\Events\AddCategoryEvent;
use App\Events\DeleteCategoryEvent;
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

        return view('admin.categories.category')->with([
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
        return view('admin.categories.realtimecategory')->with([
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

    public function update(Request $request, Category $category)
    {
        $posts = Post::where('category_id',$category->id)->count();
            $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'blogmax'=>'required|gte:'.$posts.'|numeric'
        ]);
        $category->update($data);
        $categorycount = 0;
        event (new AddCategoryEvent($categorycount));
        return back()->with(['message' => 'Success updating category']);

    }
    public function destroy(Category $category)
    {
        $post = $category->post()->doesntExist();
      if ($post) {
        $deletecategory = $category->delete();
        event (new DeleteCategoryEvent($deletecategory));
        return back()->with(['message'=>'Category Deleted Successfully']);
      }
      else {
        return back()->with(['error'=>'Delete post first with the selected category']);
      }
    }
}
