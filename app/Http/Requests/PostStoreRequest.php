<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
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

  
    public function rules()
    {
        return [
            "title" => ['required','max:255',Rule::unique('posts','title')->ignore($this->route('post'))],
            "slug" => ['required','max:255',Rule::unique('posts','slug')->ignore($this->route('post'))],
            "category_id" => 'required',
            "description" => 'min:5',
            "date" => 'date',
            "active" => 'max:1',

        ];
    }
}
