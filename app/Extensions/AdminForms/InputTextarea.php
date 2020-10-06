<?php

namespace App\Extensions\AdminForms;

class InputTextarea extends InputBase
{
    public function __construct(string $name, string $placeholder = '', ?string $value = '')
    {
        parent::__construct($name, 'textarea', $value);

        $this->attributes = [
            'placeholder' => $placeholder
        ];
    }

    public function generate() : string
    {
        return view('extensions.admin-forms.input-textarea', [
            'form' => $this
        ]);
    }
}
