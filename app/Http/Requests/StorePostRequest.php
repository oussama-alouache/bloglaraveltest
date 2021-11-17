<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
        
        if (request()->routeIs('post.store')) {
            $imageRule = 'required|image';
        } elseif (request()->routeIs('post.update')) {
            $imageRule = 'sometimes|image';
        }
        return [
            'title' => 'required',
            'content' => 'required',
            'image' => $imageRule,
            'category' => 'required'

        ];
    }
    
    protected function prepareForValidation()
    {
        if ($this->image == null) {
            $this->request->remove('image');
        }
    }

}
