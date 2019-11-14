<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectLike extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'projectlikes';
    protected $fillable = [
        'user_id', 'project_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
     
    ];

     public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
