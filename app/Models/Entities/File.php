<?php

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $casts = [
      "meta_data" => "array"
    ];

    protected $fillable = [
      "original_name", "storage_name", "extension", "meta_data", "user_id"
    ];
}
