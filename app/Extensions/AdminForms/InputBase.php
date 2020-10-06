<?php

namespace App\Extensions\AdminForms;

abstract class InputBase implements IGenerateForm
{
    public $name;
    public $type;
    public $value;
    public $class;
    public $style;
    public $attributes;

    public function __construct(
        string $name,
        string $type,
        ?string $value = '',
        string $class = '',
        string $style = '',
        array $attributes = []
    )
    {
        $this->name = $name;
        $this->type = $type;
        $this->value = $value;
        $this->class = $class;
        $this->style = $style;
        $this->attributes = $attributes;
    }

    public function getAttribute(string $name)
    {
        return isset($this->attributes[$name]) ? $this->attributes[$name] : null;
    }
}
