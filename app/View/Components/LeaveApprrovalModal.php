<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LeaveApprrovalModal extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $value,
        public $leaveStatusEnum,
        public $dexuats
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.leave-apprroval-modal');
    }
}
