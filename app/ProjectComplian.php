<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectComplian extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'projectlikes';
    protected $fillable = [
        'name', 'report','lga','image',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
     
    ];

}
