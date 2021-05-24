<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $guarded = [];
    /**
     * Get the user associated with the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function post()
    {
            return $this->hasMany(Post::class);
    }
    public function latestpost()
    {
        return $this->hasOne(Post::class)->latest();
    }
}
