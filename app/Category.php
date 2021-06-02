<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $guarded = [];


    public function getBlogmaxAttribute($value)
    {
       $posts = Post::where('category_id',$this->id)->count();
       return $value-$posts;

    }
    public function post()
    {
            return $this->hasMany(Post::class);
    }
}
