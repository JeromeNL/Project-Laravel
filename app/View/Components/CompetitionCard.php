<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CompetitionCard extends Component
{


    /**
     * Create a new component instance.
     */
    public function __construct(
        public $competition,
        public $joined,
        public $indexType,
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.competition-card');
    }
}
