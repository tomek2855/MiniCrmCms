<?php

namespace App\Http\Requests\Admin\Crm;

use App\Rules\PeselValidator;
use Illuminate\Foundation\Http\FormRequest;

class AddClientRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'email',
            'pesel' => ['digits:11', new PeselValidator],
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'Imię jest wymagane',
            'last_name.required' => 'Nazwisko jest wymagane',
            'email' => 'Adres email jest nieprawidłowy',
            'pesel.digits' => 'PESEL musi zawierać 11 cyfr',
        ];
    }
}
