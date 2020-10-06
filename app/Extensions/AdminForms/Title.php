<?php

namespace App\Extensions\AdminForms;

use stdClass;

class Title extends Raw
{
    public function __construct(string $title)
    {
        $data = new stdClass();
        $data->title = $title;

        parent::__construct('extensions.admin-forms.title', $data);
    }
}
