<?php

namespace App;

use App\MediaFile;


class ImageFile extends MediaFile {

  protected static $file_sizes = ['small', 'medium', 'large', 'extra', 'thumbnail'];

  public static function imgExists($img, $upload_dir = null, $size = null) {
    
    
    if($size) {

      $size = '_'.$size.'.';

      $img_full = preg_replace('/_[^\.]+/i', '', $img);

      $wanted = $upload_dir.str_replace('.', $size, $img_full);

      if(file_exists($wanted)) {

        return str_replace('.', $size, $img_full);
       }

    }

    if(file_exists($upload_dir.$img)) {

      return $img;
    }

    return '';

  }


  public function upload() {


    foreach(self::$file_sizes AS $size) {

     if(!isset($this->settings[$size])) continue;

     if(!isset($this->settings[$size]['width']) ||
        !isset($this->settings[$size]['height'])) continue;

      $width =    $this->settings[$size]['width'];
      $height =   $this->settings[$size]['height'];



      $thumb = storage_path($this->settings['upload_path']).$this->getUploadPath().'/'.str_replace('.', '_'.$size.'.', $this->hashName());
      $this->createThumbnail($this->file->getPathName(), $thumb, $width, $height);

    }

    $this->file->move(storage_path($this->settings['upload_path']).$this->getUploadPath(), $this->hashName());

    return $this;

  }



  public static function delete($file) {


     if(file_exists($file)) unlink($file);

     foreach(self::$file_sizes AS $size) {

        $thumb = str_replace('.', '_'.$size.'.', $file);

        if(file_exists($thumb)) unlink($thumb);

      }

   }

 protected function createThumbnail($filepath, $thumbpath, $thumbnail_width, $thumbnail_height, $background="transparent") {





    list($original_width, $original_height, $original_type) = getimagesize($filepath);

    if($thumbnail_width && $thumbnail_height == 0 &&
       $thumbnail_width > $original_width) return;

    if($thumbnail_height && $thumbnail_width == 0 &&
       $thumbnail_height > $original_height) return;

    if($thumbnail_height &&  $thumbnail_width && (
       $thumbnail_width > $original_width ||
       $thumbnail_height > $original_height)) return;


    $r = $original_width / $original_height;



    if ($original_width > $original_height) {

      $thumbnail_width = $thumbnail_width ? $thumbnail_width : intval($thumbnail_height*$r);
      $thumbnail_height = $thumbnail_height ? $thumbnail_height : intval($thumbnail_width/$r);


        $new_width = $thumbnail_width;
        $new_height = intval($original_height * $new_width / $original_width);




    } else {

      $thumbnail_width = $thumbnail_width ? $thumbnail_width : intval($thumbnail_height*$r);
      $thumbnail_height = $thumbnail_height ? $thumbnail_height : intval($thumbnail_width/$r);

        $new_height = $thumbnail_height;
        $new_width = intval($original_width * $new_height / $original_height);


    }

    $dest_x = intval(($thumbnail_width - $new_width) / 2);
    $dest_y = intval(($thumbnail_height - $new_height) / 2);

    if ($thumbnail_width && $thumbnail_height) {

      $new_width = $thumbnail_width;
      $new_height = $thumbnail_height;

    }

    if ($original_type === 1) {
        $imgt = "ImageGIF";
        $imgcreatefrom = "ImageCreateFromGIF";
    } else if ($original_type === 2) {
        $imgt = "ImageJPEG";
        $imgcreatefrom = "ImageCreateFromJPEG";
    } else if ($original_type === 3) {
        $imgt = "ImagePNG";
        $imgcreatefrom = "ImageCreateFromPNG";
    } else {
        return false;
    }

    $old_image = $imgcreatefrom($filepath);
    $new_image = imagecreatetruecolor($thumbnail_width, $thumbnail_height); // creates new image, but with a black background

    // figuring out the color for the background
    if(is_array($background) && count($background) === 3) {
      list($red, $green, $blue) = $background;
      $color = imagecolorallocate($new_image, $red, $green, $blue);
      imagefill($new_image, 0, 0, $color);
    // apply transparent background only if is a png image
    } else if($background === 'transparent' && $original_type === 3) {
      imagesavealpha($new_image, TRUE);
      $color = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
      imagefill($new_image, 0, 0, $color);
    }

    imagecopyresampled($new_image, $old_image, $dest_x, $dest_y, 0, 0, $new_width, $new_height, $original_width, $original_height);

    $imgt($new_image, $thumbpath);
    return file_exists($thumbpath);
}



}
