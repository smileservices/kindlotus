<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class ReceiveCauseUpdates extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $authenticated = false;
        if (Auth::check() || Auth::guard('ngo')->check()) {
            $authenticated = true;
        }
        return $authenticated;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'   => 'required',
            'content' => 'required',
            'images.*' => 'image|max:3000'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The update\'s title is required',
            'content.required' => 'The content is required',
            'images.*.image'  => 'The uploaded file must be an image',
            'images.*.max'  => 'The uploaded images size must be less than :max kb'
        ];
    }
}
