<?php

namespace App\Extensions\AdminForms;

class InputDate extends InputBase
{
    public function __construct(string $name, string $placeholder = '', ?string $value = '', bool $required = false)
    {
        parent::__construct($name, 'date', $value);

        $this->attributes = [
            'placeholder' => $placeholder,
            'required' => $required,
        ];
    }

    public function generate() : string
    {
        return view('extensions.admin-forms.input-date', [
            'form' => $this
        ]);
    }
}
