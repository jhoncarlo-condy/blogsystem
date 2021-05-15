<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['title','description'];

    /**
     * Get the user associated with the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function posts()
    {
            return $this->hasMany(Post::class);
    }
}
