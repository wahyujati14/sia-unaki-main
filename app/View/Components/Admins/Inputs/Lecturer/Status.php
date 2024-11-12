<?php

namespace App\View\Components\Admins\Inputs\Lecturer;

use App\Models\Lecturer;
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
        $this->statuses = Lecturer::statuses();
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
        return view('components.admins.inputs.lecturer.status');
    }
}
