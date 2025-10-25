<?php

namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Role as SpatieRole;
use Spatie\Permission\Traits\HasRoles;

class Role extends SpatieRole
{
    use SoftDeletes, HasRoles;

    protected $fillable = ['name', 'description', 'guard_name'];

    protected static function booted()
    {
        static::creating(function ($role) {
            if (empty($role->guard_name)) {
                $role->guard_name = 'web';
            }
        });
    }
}
