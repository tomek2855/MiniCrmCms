<?php

namespace App\Extensions\AdminForms;

class InputText extends InputBase
{
    public function __construct(string $name, string $placeholder = '', ?string $value = '', bool $required = false)
    {
        parent::__construct($name, 'text', $value);

        $this->attributes = [
            'placeholder' => $placeholder,
            'required' => $required,
        ];
    }

    public function generate() : string
    {
        return view('extensions.admin-forms.input-text', [
            'form' => $this
        ]);
    }
}
