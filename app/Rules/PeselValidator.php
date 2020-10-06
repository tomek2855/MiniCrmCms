<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PeselValidator implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->isValidPesel($value);
    }

    private function isValidPesel($pesel)
    {
        if (strlen($pesel) != 11) return false;

        $weight = [1, 3, 7, 9, 1, 3, 7, 9, 1, 3];
        $sum = 0;
        $controlNumber = (int)substr($pesel, -1);

        for ($i = 0; $i < count($weight); $i++) {
            $sum += (int)$pesel[$i] * $weight[$i];
        }

        $sum = $sum % 10;
        return 10 - $sum === $controlNumber;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->getMessage();
    }

    /**
     * @return string
     */
    public static function getMessage()
    {
        return 'Podaj prawidłowy numer PESEL';
    }
}
