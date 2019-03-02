<?php

namespace App\Models\Media;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
  protected $fillable = ['title', 'url', 'media_type', 'sizes'];

  public function getPublicPathAttribute() {
       
     return '/storage'.$this->url;

  }

  public function getFullPathAttribute() {

    return url($this->public_path);
    
  }

  public function exists(string $size = null) {
     
    $file = $size ? str_replace('.', "_$size.", $this->url) : $this->url;

     return file_exists(storage_path(config('media.images.upload_path')).$file);

  }


  public function getSize(string $size, $fallback = false) {

    $file = str_replace('.', "_$size.", $this->public_path);
    
    if($fallback && !$this->exists($size)) $file = $this->public_path;

    return $file;

  }

}
