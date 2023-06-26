<?php

namespace App\View\Components\CompetitionShow;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SubmissionImage extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $submissions, public $i)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.competition-show.submission-image');
    }
}
