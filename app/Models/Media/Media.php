<?php

namespace App\Models\Media;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
  protected $fillable = ['title', 'url', 'media_type', 'sizes'];
}
