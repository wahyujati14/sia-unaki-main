<?php

namespace App\View\Components\Admins\Inputs\StudyPlanCard;

use App\Models\StudyPlanCard;
use Illuminate\View\Component;

class Status extends Component
{
    public $statuses;

    public $value;

    public $props;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($value = null, array $props = [])
    {
        $this->statuses = StudyPlanCard::statuses();
        $this->value = $value;
        $this->props = $props;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admins.inputs.study-plan-card.status');
    }
}
