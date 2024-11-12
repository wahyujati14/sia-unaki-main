<?php

namespace App\View\Components\Admins\Inputs;

use App\Models\AcademicYear as ModelsAcademicYear;
use Illuminate\View\Component;

class AcademicYear extends Component
{
    public $academic_years;

    public $value;

    public $props;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($value = null, array $props = [])
    {
        $this->academic_years = ModelsAcademicYear::orderBy('first_year', 'asc')->get();
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
        return view('components.admins.inputs.academic-year');
    }
}
