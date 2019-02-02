<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MediaUploadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {   
        

        return [
            'file'=> ['required', 
                      'image', 
                      'max:'.config('media.images.file_size.max'),
                      'mimetypes:'.implode(',', config('media.images.formats'))]
        ];
    }
}
