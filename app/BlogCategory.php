<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategory extends Model
{
    use SoftDeletes;
    
    public function posts()
    {
        return $this->hasMany(Blog::class,  'category_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo('App\BlogCategory', 'parent_id');
    }
}
