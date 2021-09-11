<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Dropdown extends Component
{

    public $trigger;
    public $content;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($trigger, $content)
    {
        $this->trigger = $trigger;
        $this->content = $content;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dropdown');
    }
}
