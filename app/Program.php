<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Program extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'org_id', 'approved_by', 'user_id', 'name', 'description', 'banner',
        'location', 'start_time', 'end_time', 'max_participants',
        'reg_open_time', 'reg_close_time', 'status', 'note',
    ];

    protected $casts = [
        'start_time'      => 'datetime',
        'end_time'        => 'datetime',
        'reg_open_time'   => 'datetime',
        'reg_close_time'  => 'datetime',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'org_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
