<?php

namespace App\Extensions;

use App\Extensions\AdminForms\InputBase;

class AdminForm
{
    public $inputs = [];
    public $buttons = false;

    public function add(InputBase $input)
    {
        $this->inputs[] = $input;
    }

    public function addButtons()
    {
        $this->buttons = true;
    }

    public function generate(string $url = '')
    {
        if (strlen($url) > 0)
        {
            $output = '<form method="POST" action="' . $url . '">';
        }
        else
        {
            $output = '<form>';
        }

        foreach ($this->inputs as $input)
        {
            $output .= $input->generate();
        }

        if ($this->buttons)
        {
            $output .= view('extensions.admin-forms.buttons');
        }

        $output .= '</form>';

        return $output;
    }
}
