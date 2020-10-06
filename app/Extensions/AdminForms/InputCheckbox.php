<?php

namespace App\Extensions\AdminForms;

class InputCheckbox extends InputBase
{
    public function __construct(string $name, string $placeholder = '', string $value = '')
    {
        parent::__construct($name, 'checkbox', $value);

        $this->attributes = [
            'placeholder' => $placeholder,
        ];
    }

    public function generate() : string
    {
        return view('extensions.admin-forms.input-checkbox', [
            'form' => $this
        ]);
    }
}
