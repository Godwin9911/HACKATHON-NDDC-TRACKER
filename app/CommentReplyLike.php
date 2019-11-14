<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentReplyLike extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'commentreplylikes';
    protected $fillable = [
        'user_id', 'project_id', 'comment_id', 'reply_id',
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
      public function user()
    {
        return $this->belongsTo(Project::class);
    }
     public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
