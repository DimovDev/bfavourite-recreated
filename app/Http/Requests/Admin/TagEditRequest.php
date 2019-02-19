<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TagEditRequest extends FormRequest
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
            'name'=>'required|max:50|min:2|regex:/[a-z0-9 _-]+/iu',
            'slug' => 'nullable|max:100|min:2|regex:/[a-z0-9 _-]+/iu',
            'taxonomy_status' => 'required|regex:/[a-z0-9 _-]+/iu|max:50',
            'summary' => 'nullable|max:500',
            'asset_id' => 'nullable',
            'tags' => 'nullable',
        ];

    }
}
