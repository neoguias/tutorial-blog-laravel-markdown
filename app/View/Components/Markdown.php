<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Cache;

class Markdown extends Component
{
    private $viewName;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($viewName){
        $this->viewName = $viewName;
    }

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view($this->viewName);
    }
}