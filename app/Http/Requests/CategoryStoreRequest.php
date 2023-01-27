<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
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
            "name" => ['required','max:255',Rule::unique('categories','name')->ignore($this->route('category'))],
            "slug" => ['required','max:255',Rule::unique('categories','slug')->ignore($this->route('category'))],

        ];
    }
}
