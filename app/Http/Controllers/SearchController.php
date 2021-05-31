<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        if($request->ajax()){
            $data = Category::where('title','like','%'.$request->search.'%')
            ->get();

            return response()->json($data);
        }
    }
}
