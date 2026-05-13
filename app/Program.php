<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Program extends Model
{
    use HasFactory, SoftDeletes;

    public static function boot()
    {
        parent::boot();

        static::saving(function ($program) {
            if (empty($program->slug) || $program->isDirty('name')) {
                $program->slug = Str::slug($program->name);
                
                // Ensure unique slug
                $count = static::where('slug', 'LIKE', $program->slug . '%')->where('id', '!=', $program->id)->count();
                if ($count > 0) {
                    $program->slug .= '-' . ($count + 1);
                }
            }
        });
    }

    protected $fillable = [
        'org_id', 'approved_by', 'user_id', 'name', 'slug', 'description', 'short_description', 'banner',
        'location', 'google_map', 'start_time', 'end_time', 'max_participants',
        'status', 'note', 'meta_title', 'meta_description',
    ];

    protected $casts = [
        'start_time'      => 'datetime',
        'end_time'        => 'datetime',
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

    public function donationRecords()
    {
        return $this->hasMany(DonationRecord::class);
    }
}
