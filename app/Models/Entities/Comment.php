<?php

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      "content", "user_id", "file_id", "parent_id"
    ];

    /**
     * Get the author of the comment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo("App\Models\Entities\User");
    }

    /**
     * Get the parent comment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo('App\Models\Entities\Comment', 'parent_id');
    }

    /**
     * Get comment replies.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies()
    {
        return $this->hasMany('App\Models\Entities\Comment', 'parent_id');
    }
}
