<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Auswahl extends Component
{

    public $matchings;
    public $text;
    public $assign;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($matchings, $text, $assign)
    {
        $this->matchings = $matchings;
        $this->text = $text;
        $this->assign = $assign;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.auswahl');
    }
}
