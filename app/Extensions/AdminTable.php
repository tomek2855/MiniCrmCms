<?php

namespace App\Extensions;

class AdminTable
{
    public $data;

    public $title;
    public $columns;
    public $buttonsColumn;
    public $search;

    public $links;

    public $functionStorage = null;

    public function __construct($data, array $columns, string $title = '', $buttonsColumn = false, $search = false)
    {
        $this->data = $data;
        $this->columns = $columns;
        $this->title = $title;
        $this->buttonsColumn = $buttonsColumn;
        $this->search = $search;

        if ($data instanceof \Illuminate\Pagination\LengthAwarePaginator)
        {
            $this->links = $data->links();
        }

        $this->functionStorage = new AdminTableFunctionStorage();
    }

    public function addFunction(string $name, callable $function)
    {
        $this->functionStorage->add($name, new AdminTableFunction($function));
    }

    public function generate()
    {
        return view('extensions.admin-table', [
            'data' => $this->data,
            'columns' => $this->columns,
            'title' => $this->title,
            'buttonsColumn' => $this->buttonsColumn,
            'search' => $this->search,
            'links' => $this->links,
            'functions' => $this->functionStorage
        ]);
    }
}

class AdminTableFunctionStorage
{
    private $functions = [];

    public function add(string $name, AdminTableFunction $function)
    {
        if (array_key_exists($name, $this->functions))
        {
            throw new \Exception('Function named "' . $name . '" already exists');
        }

        $this->functions[$name] = $function;
    }

    public function call(string $name, object $item) : string
    {
        if (!array_key_exists($name, $this->functions))
        {
            throw new \Exception('There is no function named "' . $name . '"');
        }

        return $this->functions[$name]->call($item);
    }
}

class AdminTableFunction
{
    private $function;

    public function __construct(callable $function)
    {
        $this->function = $function;
    }

    public function call($item) : string {
        return call_user_func($this->function, $item);
    }
}
