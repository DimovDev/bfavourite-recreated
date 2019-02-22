<?php

namespace App\Models\Media;

use Illuminate\Http\UploadedFile as LaravelUploadedFile;
use Illuminate\Support\Facades\Validator;
use App\Models\Media\ImageFile;
use App\Exceptions\UrlImageException;

class UrlImage extends ImageFile {

    protected $url;



    public function __construct(string $url, array $settings)  {
        
        $url = strtok($url,'?');
        $this->url = $url;

        $this->setSettings($settings);
       

        $file_headers = @get_headers($url);

        if (\stripos($file_headers[0],"404 Not Found") >0  || (stripos($file_headers[0], "302 Found") > 0 && stripos($file_headers[7],"404 Not Found") > 0)) {
                throw new UrlImageException('The OG image does\'nt exist.');
        }

        if(\stripos(\implode('###', $file_headers), 'image/') < 1) {
              
            throw new UrlImageException('The OG image is not an image.');
        }

        
        $temp =  sys_get_temp_dir().'/'.pathinfo($url, PATHINFO_BASENAME);
        $result = \copy($url, $temp); 

        
        $finfo = new \finfo(FILEINFO_MIME_TYPE );
        $mime_type = $finfo->file($temp);

        if(!in_array($mime_type, $this->settings['formats'])) {

            unlink($temp);
            throw new UrlImageException('The OG image\'s format('.$mime_type.') isn\'t allowed.');
        }

        if(filesize($temp) > $this->settings['file_size']['max']) {

            unlink($temp);
            throw new UrlImageException('The OG image is too big.');
        }

       
         
        $extensions =  explode('/', $finfo->file($temp, FILEINFO_EXTENSION ));
        $basename_extension = explode('.', $temp);
        $basename_extension = $basename_extension[count($basename_extension) - 1];
        
        if(!in_array($basename_extension, $extensions)) {

            unlink($temp);
            throw new UrlImageException('The OG image has wrong extension ('.$basename_extension.').');

        }

        $this->extension = $basename_extension;
        $this->pathName = $temp;
        $this->media_type = $mime_type;
        $this->file_name =  pathinfo($temp, PATHINFO_BASENAME);
        
    }

  
    public function move($destination, $name) {

        \rename($this->getPathName(), rtrim($destination, '/').'/'.$name);

    }



}