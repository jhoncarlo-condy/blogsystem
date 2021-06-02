<?php

namespace App\Http\Controllers\User;

use App\Post;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $query = Category::select(
            'id',
            'title');
        $lists = $query->paginate(4);
        $categories = $query->with(['post'=>function($qry){
            $qry->orderBy('id','desc');
        }])->orderBy('id','desc')->paginate(4);

        return view ('users.categories.index')->with([
            'lists'=>$lists,
            'categories'=>$categories,
        ]);
    }
    public function show(Category $category)
    {
        $categories = Category::select(
            'id',
            'title')->get();
        $posts = Post::select(
            'id',
            'title',
            'category_id',
            'user_id',
            'image',
            'created_at')
            ->where('category_id',$category->id)
            ->orderBy('id','desc')->paginate(4);
        return view ('users.categories.show')->with([
            'categories'=>$categories,
            'category'=>$category,
            'posts'=>$posts,
        ]);
    }
    public function all()
    {
        $datas = Category::select(
            'id',
            'title')->get();
        return view('users.categories.allcategory')->with([
            'datas'=>$datas
        ]);
    }
}
