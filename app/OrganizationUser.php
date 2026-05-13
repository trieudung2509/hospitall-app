<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrganizationUser extends Model
{
    use HasFactory;

    protected $table = 'organization_users';

    protected $fillable = [
        'user_id', 'org_id', 'status', 'note',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'org_id');
    }
}
