<?php

namespace App\Extensions\AdminForms;

class InputRadio extends InputBase
{
    public $values;

    public function __construct(string $name, string $placeholder = '', string $value = '', array $values = [])
    {
        parent::__construct($name, 'radio', $value);

        $this->values = $values;

        $this->attributes = [
            'placeholder' => $placeholder,
        ];
    }

    public function generate() : string
    {
        return view('extensions.admin-forms.input-radio', [
            'form' => $this
        ]);
    }
}
