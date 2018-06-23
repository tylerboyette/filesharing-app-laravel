<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $casts = [
      "meta_data" => "array"
    ];
}
