<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'feedback_update',
        'saved_project_update',
        'project_location_update',
        'new_project_update',
        'newsletter_update',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id'
    ];
}
