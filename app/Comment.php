<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'project_id', 'user_name',
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
        return $this->hasOne(Project::class);
    }
     public function commentlikes()
    {
        return $this->hasMany(CommentLike::class);
    }
      public function commentreplys()
    {
        return $this->hasMany(CommentReply::class);
    }
       public function commentreplylikes()
    {
        return $this->hasMany(CommentReplyLike::class);
    }

}