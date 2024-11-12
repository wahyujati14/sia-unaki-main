<?php

namespace App\View\Components\Admins\Inputs;

use App\Models\StudyPlanCard as ModelsStudyPlanCard;
use Illuminate\View\Component;

class StudyPlanCard extends Component
{
    public $cards;

    public $value;

    public $props;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($value = null, array $props = [])
    {
        $this->cards = ModelsStudyPlanCard::with(['user', 'academic_year'])->get();
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
        return view('components.admins.inputs.study-plan-card');
    }
}
