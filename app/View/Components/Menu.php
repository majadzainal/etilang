<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class Menu extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $active;
    public function __construct($active)
    {
        $this->active = $active;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.menu');
    }
    public function list()
    {
        $user = Auth::user();

        if($user->IsAdmin())
        {
            return [
                [
                    'label' => 'dashboard'
                ],
                [
                    'label' => 'pelanggaran'
                ],
                [
                    'label' => 'pasal'
                ],
                [
                    'label' => 'ktp'
                ],
                [
                    'label' => 'users'
                ],
                [
                    'label' => 'logs'
                ],
            ];
        }else{
            return [
                [
                    'label' => 'dashboard'
                ],
                [
                    'label' => 'pelanggaran'
                ],
                [
                    'label' => 'ktp'
                ],
            ];
        }
        
    }

    public function IsActive($label)
    {
        return $label === $this->active;
    }
}
