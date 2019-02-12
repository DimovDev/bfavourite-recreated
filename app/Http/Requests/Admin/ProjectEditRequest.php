<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProjectEditRequest extends FormRequest
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
        'title'=>'required|max:50|min:2',
        'slug' => 'nullable|max:100|min:2|regex:/[a-z0-9 _-]+/iu',
        'asset_status' => 'required|regex:/[a-z0-9 _-]+/iu|max:50',
        'content' => 'required',
        'summary' => 'nullable|max:500',
        'published_at' => 'date',
        'meta.github_url' =>'bail|nullable|active_url',
        'meta.live_url' => 'bail|nullable|active_url',
        'categories' => 'required'

        ];

    }
}
