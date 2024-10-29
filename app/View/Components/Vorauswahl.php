<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Vorauswahl extends Component
{

    public $matchings;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($matchings)
    {
        $this->matchings = $matchings;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.vorauswahl');
    }
}
