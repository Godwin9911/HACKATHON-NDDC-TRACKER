<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectSave extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'owner_id', 'project_id', 'comment'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
       
    ];
}
