<?php

namespace App\Extensions\AdminForms;

class Raw extends InputBase
{
    public $view;
    public $data;

    public function __construct($view, object $data = null)
    {
        parent::__construct('', '');

        $this->view = $view;
        $this->data = $data;
    }

    public function generate() : string
    {
        return view($this->view, [
            'data' => $this->data,
        ]);
    }
}
