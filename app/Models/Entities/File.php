<?php

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    /**
     * The attributes that should cast to native types
     *
     * @var array
     */
    protected $casts = [
      "meta_data" => "array"
    ];

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
      "original_name", "storage_name", "extension", "meta_data", "user_id", "has_related_icon"
    ];

    /**
     * Get the owner of the file
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo("App\Models\Entities\User");
    }

    /**
     * Get comments for the file
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany("App\Models\Entities\Comment");
    }
}
