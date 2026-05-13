<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
  protected $fillable = ['first_name', 'last_name', 'phone_number', 'email', 'message', 'file_id'];

  public function upload() {
    return $this->belongsTo(Upload::class, 'file_id');
}
}
