<?php

namespace App\Models\Media;

use Illuminate\Http\UploadedFile;
use App\Models\Media\ImageFile;


class UploadedImage extends ImageFile {
   
    protected $file;

    public function __construct(UploadedFile $file, array $settings) {

        $this->file = $file;
        $this->settings = $settings;
    
        $this->setUploadPath();
    
        $this->media_type = $this->file->getClientMimeType();
        $this->extension =  $this->file->guessExtension();
        $this->file_name = $this->file->getClientOriginalName();
        $this->pathName = $this->file->getPathName();
    
      }


      public function move($path, $file_name) {

        return $this->file->move($path, $file_name);
        
      }



}


