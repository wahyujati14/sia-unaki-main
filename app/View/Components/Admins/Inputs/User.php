<?php

namespace App\View\Components\Admins\Inputs;

use App\Models\User as ModelsUser;
use Illuminate\View\Component;

class User extends Component
{
    public $users;

    public $value;

    public $props;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($value = null, array $props = [])
    {
        $this->users = ModelsUser::orderBy('nim')->get();
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
        return view('components.admins.inputs.user');
    }
}
