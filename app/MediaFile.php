<?php

namespace App;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

abstract class MediaFile {



  protected $file;

  protected $hashName = null;


  protected $settings; // ['upload_path', 'small', 'medium', 'large', 'extra];
  

  protected $upload_path;

  protected $media_type;
  protected $file_name; 
  protected $extension;

  public function __construct(UploadedFile $file, array $settings) {

    $this->file = $file;
    $this->settings = $settings;

    $this->setUploadPath();

    $this->media_type = $this->file->getClientMimeType();
    $this->extension =  $this->file->guessExtension();
    $this->file_name = $this->file->getClientOriginalName();

  }

  abstract public function upload();

  abstract public static function delete($file);


  public function getClientFilename() {

    return $this->file_name;

  }

  public function getClientMediaType() {

    return $this->media_type;

  }



  public function setUploadPath($path = null) {
    $full_path = \storage_path($this->settings['upload_path']).'/'.$path;

    if(!is_dir($full_path)) {

      throw new \Exception('No such file or directory: '.$full_path);
    }

    $full_path = rtrim($full_path, '/').'/'.date('mY');

    if(!is_dir($full_path)) {

      if(!mkdir($full_path)) {

        throw new \Exception('Cannot create the directory: '.$path);

      }

    }

     $this->upload_path = $path ? $path.'/'.date('mY') : date('/mY');

     return $this;

  }


  public function getUri() {

    return $this->getUploadPath().'/'.$this->hashName();

  }


  public function getUploadPath() {

    return rtrim($this->upload_path, '/');

  }

     /**
     * Get a filename for the file.
     *
     * @param  string  $path
     * @return string
     */
    public function hashName($path = null)
    {
        if ($path) {
            $path = rtrim($path, '/').'/';
        }

        $hash = $this->hashName ?: $this->hashName = Str::random(40);

        if ($extension = $this->guessExtension()) {
            $extension = '.'.$extension;
        }

        return $path.$hash.$extension;
    }


    public function guessExtension() {

      return $this->extension;

    }


}
