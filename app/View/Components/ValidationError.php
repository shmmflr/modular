<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ValidationError extends Component
{

    public string $filed;

    public function __construct($filed)
    {
        $this->filed = $filed;
    }

    public function render()
    {
        return view('components.validation-error');
    }
}
