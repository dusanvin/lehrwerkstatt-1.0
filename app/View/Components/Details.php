<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Details extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($lehr, $stud, $mse)
    {
        $this->lehr = $lehr;
        $this->stud = $stud;
        $this->mse = $mse;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.details', ['lehr' => $this->lehr, 'stud' => $this->stud, 'mse' => $this->mse]);
    }
}
