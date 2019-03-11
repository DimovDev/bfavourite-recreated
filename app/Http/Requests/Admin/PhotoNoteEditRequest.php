<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PhotoNoteEditRequest extends FormRequest
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
            'title'=>'required|max:255|min:2',
            'slug' => 'nullable|max:500|min:2|regex:/[a-z0-9 _-]+/iu',
            'asset_status' => 'required|regex:/[a-z0-9 _-]+/iu|max:50',
            'content' => 'nullable',
            'summary' => 'nullable|max:500',
            'published_at' => 'date',
            'tags' => 'required',
            'photo_id' => 'nullable'


        ];
    }
}
