<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserRole
 *
 * @property int $user_id
 * @property int $role_id
 */
class UserRole extends Model
{
    protected $fillable = [
        'user_id',
        'role_id',
    ];

    public $timestamps = false;
}
