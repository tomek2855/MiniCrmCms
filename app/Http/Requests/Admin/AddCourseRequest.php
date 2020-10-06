<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AddCourseRequest extends FormRequest
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
            'name' => 'required',
            'description' => 'required',
            'is_active' => '',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nazwa kursu jest wymagana',
            'description.required' => 'Opis kursu jest wymagany',
        ];
    }
}
