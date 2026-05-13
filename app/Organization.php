<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organization extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'org_name', 'org_type', 'status', 'contact_person', 'contact_phone', 'contact_email', 'start_time'
    ];

    public function programs()
    {
        return $this->hasMany(Program::class, 'org_id');
    }

    public function organizationUsers()
    {
        return $this->hasMany(OrganizationUser::class, 'org_id');
    }

    public function linkedUser()
    {
        $pivot = $this->organizationUsers()->first();
        return $pivot ? $pivot->user : null;
    }
}
