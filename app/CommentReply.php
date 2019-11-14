<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
	 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'commentreplys';
    protected $fillable = [
        'user_id', 'project_id','comment_id', 'user_name',
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

        public function replylikes()
    {
        return $this->hasMany(CommentReplyLike::class);
    }

}
