<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_title', '', 'email', 'password', 'phone', 'image', 'verifycode', 'role', 'user_type', 'device_id', 'accept_terms'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email_verified_at', 'verifycode', 'role', 'fcm_token','google_id', '2_factor_enabled', 'accept_terms'
    ];

}