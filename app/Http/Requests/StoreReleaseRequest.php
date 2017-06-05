<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReleaseRequest extends FormRequest
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
            'label' => 'required',
            'recording' => 'required',
            'format' => 'required',
            'country' => 'required',
            'slug' => 'required',
            'year' => 'numeric',
            'catalog_no' => 'required',
        ];
    }
}
