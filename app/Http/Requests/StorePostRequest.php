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
     * @return array<string, mixed>
     */
    public function rules()
    {
        // $rules = [
        //     'title' => 'required',
        //     'slug' => 'required|unique:posts,slug',
        //     'content' => 'required',
        // ];
        
        // if($this->get('image'))
        //     $rules = array_merge($rules, ['image', 'mimes:jpg,jpeg,png']);
        // return $rules;

        return [
            'title' => 'required|unique:posts|max:255',
            'slug' => 'required|unique:posts,slug',
            'body' => 'required',
            'image' => 'image | mimes:jpeg,png,jpg',
        ];

    }

    public function messages()
    {
        return [
            'title.required' => 'title is required!',
            'slug.required' => 'slug is required!',
            'body.required' => 'content is required!',
            'image' => 'the file must be a image!',
        ];
    }
}
