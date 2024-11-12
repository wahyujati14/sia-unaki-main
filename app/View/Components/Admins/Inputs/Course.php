<?php

namespace App\View\Components\Admins\Inputs;

use App\Models\Course as ModelsCourse;
use Illuminate\View\Component;

class Course extends Component
{
    public $courses;

    public $value;

    public $props;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($value = null, array $props = [])
    {
        $this->courses = ModelsCourse::get();
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
        return view('components.admins.inputs.course');
    }
}