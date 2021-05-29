<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpadeRequest extends FormRequest
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
            'title' => ['required','min:5'],
            'slug' => ['required','min:5'],
            'cost' => ['required','integer'],
            'category_id' => ['required','exists:categories,id'],
            'brand_id' => ['required','exists:brands,id'],
            'image' => ['nullable','image','mimes:jpeg,png,jpg,gif,svg','max:1024'],
            'description' => ['required','min:10'],
        ];
    }
}
