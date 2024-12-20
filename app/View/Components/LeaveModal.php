<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LeaveModal extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $id,
        public $dexuats,
        public $restTypes,
        public $typeOfVacations,
        public $ngayPheps
    ) {

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.leave-modal');
    }
}
