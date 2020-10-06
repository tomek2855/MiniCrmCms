<?php

namespace App\Http\Requests;

use App\Rules\PeselValidator;
use App\Rules\ReCaptchaValidator;
use Illuminate\Foundation\Http\FormRequest;

class CourseFormRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'number' => 'required|numeric',
            'pesel' => ['required', 'digits:11', new PeselValidator],
            'address_number' => 'required|string|max:255',
            'address_street' => 'required|string|max:255',
            'address_city' => 'required|string|max:255',
            'address_zipcode' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
            //'g-recaptcha-response' => ['required', new ReCaptchaValidator],
            // Commented for tests
        ];
    }
}
