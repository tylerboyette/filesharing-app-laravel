<?php

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
      "content", "user_id", "file_id"
    ];
}
