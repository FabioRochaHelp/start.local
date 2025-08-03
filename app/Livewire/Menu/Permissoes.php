<?php

namespace App\Livewire\Menu;

use Livewire\Component;
use App\Models\Menu;
use App\Models\UserType;

class Permissoes extends Component
{
    public $menus;
    public $menu;
    public $types;
    public $type;

    /**
     * Create a new component instance.
     *
     * @param  mixed  $menus
     * @param  mixed  $menu
     */

    public function mount()
    {
        $this->menus = $this->getMenus();
        $this->types = UserType::all();
    }

    public function getMenus()
    {
        // Logic to fetch menus from the database or any other source
        $this->menus = Menu::all();
    }   

    public function render()
    {
        return view('livewire.menu.permissoes');
    }
}
