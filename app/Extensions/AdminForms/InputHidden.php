<?php

namespace App\Extensions\AdminForms;

class InputHidden extends InputBase
{
    public function __construct(string $name, string $value = '')
    {
        parent::__construct($name, 'hidden', $value);
    }

    public function generate() : string
    {
        return view('extensions.admin-forms.input-hidden', [
            'form' => $this
        ]);
    }
}
