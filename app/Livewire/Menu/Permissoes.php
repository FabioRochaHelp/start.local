<?php

namespace App\Livewire\Menu;

use Livewire\Component;
use App\Models\Menu;
use App\Models\UserType;
use App\Models\MenuUsersType;

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

    public function addPermissoes($menu, $type)
    {
        $menuUserType = MenuUsersType::firstOrCreate([
            'menu_id' => $menu,
            'user_type_id' => $type,
        ]);

        $this->dispatch('toast', [
            'message' => 'Permiss o adicionada com sucesso!',
            'type' => 'success',
        ]);
    }

    public function remPermissoes($menu, $type)
    {
        MenuUsersType::where('menu_id', $menu)->where('user_type_id', $type)->delete();

        $this->dispatch('toast', [
            'message' => 'Permiss o removida. O acesso será negado!',
            'type' => 'warning',
        ]);
    }

    public function togglePermissao($menuId, $typeId, $checked)
    {
        if ($checked) {
            $this->addPermissoes($menuId, $typeId);
        } else {
            $this->remPermissoes($menuId, $typeId);
        }
    }

    public function render()
    {
        return view('livewire.menu.permissoes');
    }
}
