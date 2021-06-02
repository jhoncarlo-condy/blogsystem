<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)

    {
        if($request->has('title')){
            $title = $request->title;

            $result = Category::where('title','like','%'.$title.'%')->get();
                return response()->json(['result'=>$result]);

            // return $result->toArray(['result'=>$result]);
        }else{
        return view('users.profile.index');
        }
    }
}
