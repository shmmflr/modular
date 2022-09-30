<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TextArea extends Component
{
    public string $name;
    public string $placeholder;

    public function __construct($name, $placeholder)
    {
        //
        $this->name = $name;
        $this->placeholder = $placeholder;
    }


    public function render()
    {
        return view('components.text-area');
    }
}
