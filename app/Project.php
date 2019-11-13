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
        'PROJECT_TYPE', 'LOCATION', 'LGA', 'PROJECT_DESCRIPTION', 'BUDGET_COST', 'COMMITMENT', 'AMOUNT_APPROVED_2016', 'AMOUNT_APPROVED_2017'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function projectlikes()
    {
        return $this->hasMany(ProjectLike::class);
    }

}