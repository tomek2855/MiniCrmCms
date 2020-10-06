<?php

namespace App\Rules;

use GuzzleHttp\Client;
use Illuminate\Contracts\Validation\Rule;

class ReCaptchaValidator implements Rule
{
    private $privateKey;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->privateKey = config('services.recaptcha.private');
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
        $client = new Client();
        $response = $client->post('https://www.google.com/recaptcha/api/siteverify',
            [
                'form_params' =>
                    [
                        'secret' => $this->privateKey,
                        'response' => $value
                    ]
            ]
        );

        $responseBody = json_decode((string)$response->getBody());

        return (bool)$responseBody->success;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return self::getMessage();
    }

    /**
     * @return string
     */
    public static function getMessage()
    {
        return 'Potwierdź, że nie jesteś robotem';
    }
}
