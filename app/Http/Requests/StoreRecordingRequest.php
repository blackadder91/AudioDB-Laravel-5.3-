<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRecordingRequest extends FormRequest
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
            'artist' => 'required',
            'album_type' => 'required',
            'genre' => 'required',
            'title' => 'required',
            'year' => 'required|numeric',
            'slug' => 'required|unique:recordings',
            'image' => 'required_without:image_url',
        ];
    }
}
