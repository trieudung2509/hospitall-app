<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory,SoftDeletes;
    
    public function category() {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

    public function author() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
