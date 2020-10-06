<?php

namespace App\Http\Requests;

use App\Rules\ReCaptchaValidator;
use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
{
    protected $redirect = '/#kontakt';

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
            'name' => 'required|max:255|min:3',
            'email' => 'required|email|max:255',
            'content' => 'required',
            //'g-recaptcha-response' => ['required', new ReCaptchaValidator],
            // Commented for tests
        ];
    }
}
