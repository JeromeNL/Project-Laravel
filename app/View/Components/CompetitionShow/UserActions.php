<?php

namespace App\View\Components\CompetitionShow;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UserActions extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $competition,
        public $joined,
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.competition-show.user-actions');
    }
}
