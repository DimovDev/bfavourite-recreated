<?php

return ['images' =>['upload_path' =>'app/public',
                   'file_size' => ['min' => null, 'max' => '5000'],
                   'small' =>['width' => 350,  'height' => 0],
                   'medium'=>['width' => 768, 'height'=> 0],
                   'large' =>['width'=>1366,  'height'=> 0],
                   'extra' =>['width'=>1920,  'height'=> 0],
                   'formats' => ['image/jpg', 'image/png', 'image/gif', 'image/jpeg'] 
                   ]
        ];