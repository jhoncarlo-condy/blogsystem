<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::paginate(5);
        return view('admin.category', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:categories,title',
            'description' => 'required',

        ]);

        $category = new Category;
        $category->title = $request->title;
        $category->description = $request->description;
        $category->save();


        return redirect()->back()->with(['message'=>'Added new category']);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $category = Category::find($category->id);
        return view('category.index',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',

        ]);

        // Category::find($category->id)->update($request->all());
        $cat = Category::find($category->id);
        $cat->title = $request->title;
        $cat->description = $request->description;
        $cat->update();

        return redirect()->back()->with(['message' => 'Success updating category']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $cat = Post::where('category_id', $id)->doesntExist();
      if ($cat == true) {
            Category::find($id)->delete();
            return redirect()->back()->with(['message'=>'Category Deleted Successfully']);
      }
      else {
          return redirect()->back()->with(['message'=>'Delete post with this category before deleting category']);
      }
    }
}
