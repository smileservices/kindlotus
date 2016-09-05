<?php

namespace App\Http\Requests;

use Auth;

use App\Http\Requests\Request;
use App\Cause;

class EditCauseRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $cause = $this->route('cause');
        $ngo = Auth::guard('ngo')->user();

        if  (Auth::guard('admin')->check())
        {
            return true;
        }

        if ($cause->ngo_id == $ngo->id)
        {

            if ($this->input('active') && $this->input('active') > 1) {
                return false;
            }
            return true;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method())
        {
            case 'GET':
                return [];
            case 'DELETE':
                return [];
            case 'PATCH':
                if ($this->input('submit') == 'text_update'){
                    return [
                        'name' => 'required',
                        'story' => 'required',
                        'description' => 'required|max:255',
                        'contact' => 'required',
                    ];
                } elseif ($this->file()) {
                    return [
                        'images.*' => 'image|max:3000'
                    ];
                }

            default:
                return [];
        }

    }

    public function messages()
    {
        return [
            'name.required' => 'The cause\'s name is required',
            'story.required' => 'The story is required',
            'contact.required' => 'The contact is required',
            'images.*.image'  => 'The uploaded file must be an image',
            'images.*.max'  => 'The uploaded image size must be less than :max kb'
        ];
    }


}
