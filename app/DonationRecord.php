<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DonationRecord extends Model
{
    use HasFactory, SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id', 'user_id', 'program_id', 'status', 'registration_time',
        'check_in_time', 'blood_type_verified', 'blood_volume',
        'health_status', 'failure_reason', 'notes', 'EmailConfirm',
    ];

    protected $casts = [
        'registration_time' => 'datetime',
        'check_in_time'     => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}
