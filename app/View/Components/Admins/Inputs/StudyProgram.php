<?php

namespace App\View\Components\Admins\Inputs;

use App\Models\StudyProgram as ModelsStudyProgram;
use Illuminate\View\Component;

class StudyProgram extends Component
{
    public $study_programs;

    public $value;

    public $props;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($value = null, array $props = [])
    {
        $this->study_programs = ModelsStudyProgram::orderBy('name', 'asc')->get();
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
        return view('components.admins.inputs.study-program');
    }
}
