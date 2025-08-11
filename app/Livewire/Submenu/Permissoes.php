<?php

namespace App\Livewire\Submenu;

use App\Models\Menu;
use App\Models\SubMenu;
use App\Models\UserType;
use App\Models\SubMenuUsersType;

use Livewire\Component;

class Permissoes extends Component
{
    public $menus;
    public $menu;
    public $subMenus;
    public $subMenu;
    public $types;
    public $type;
    public $subMenuUsersTypes;
    public $name;
    public $url;
    public $menuId;
    public $icon;

    /**
     * Create a new component instance.
     *
     * @param  mixed  $menus
     * @param  mixed  $menu
     */

    public function mount()
    {
        $this->menus = $this->getMenus();
        $this->subMenus = $this->menu ? $this->menu->subMenus : [];
        $this->menuId = $this->menu ? $this->menu->id : null;
        $this->types = UserType::all();
        $this->subMenuUsersTypes = SubMenuUsersType::all();
    }

    public function save()
    {
        /*  $this->validate([
            'name' => 'required|exists:menus,id',
            'subMenu' => 'required|exists:sub_menus,id',
        ]); */

        // Logic to save the permissions
        // This could involve saving the selected subMenu and types to the database

        $this->dispatch('toast', [
            'message' => 'Permissões salvas com sucesso!',
            'type' => 'success',
        ]);
        $this->reset(['menu', 'subMenu', 'type']);
        $this->subMenus = $this->menu ? $this->menu->subMenus : [];
        $this->subMenuUsersTypes = SubMenuUsersType::where('sub_menu_id', $this->subMenu)->get();
        $this->dispatch('refreshSubMenuList'); // Dispatch an event to refresh the submenu list
    }

    public function createSubmenu()
    {
        $this->validate([
            'name' => ['required', function ($attribute, $value, $fail) {
                if (SubMenu::where('menu_id', $this->menuId)->where('name', $value)->exists()) {
                    $fail('O submenu ' . $value . ' já existe para este menu.');
                }
            }],
            'url' => ['required', function ($attribute, $value, $fail) {
                if (SubMenu::where('menu_id', $this->menuId)->where('url', $value)->exists()) {
                    $fail('A url ' . $value . ' já existe para este menu.');
                }
            }],
        ]);

        SubMenu::create([
            'name' => $this->name,
            'url' => $this->url,
            'icon' => $this->icon,
            'menu_id' => $this->menuId,
        ]);

        $this->dispatch('toast', [
            'message' => 'Submenu criado com sucesso!',
            'type' => 'success',
        ]);

        $this->reset(['name', 'url']);
        $this->subMenus = $this->menu ? $this->menu->subMenus : [];

        $this->dispatch('closeModal', id: 'report1');
    }

    public function getMenus()
    {
        // Logic to fetch menus from the database or any other source
        $this->menus = Menu::all();
    }

    public function addPermissoes($subMenu, $type)
    {
        $subMenuUserType = SubMenuUsersType::firstOrCreate([
            'sub_menu_id' => $subMenu,
            'user_type_id' => $type,
        ]);

        $this->dispatch('toast', [
            'message' => 'Permissão adicionada com sucesso!',
            'type' => 'success',
        ]);
    }

    public function remPermissoes($subMenu, $type)
    {
        SubMenuUsersType::where('sub_menu_id', $subMenu)->where('user_type_id', $type)->delete();

        $this->dispatch('toast', [
            'message' => 'Permissão removida. O acesso será negado!',
            'type' => 'warning',
        ]);
    }

    public function togglePermissao($subMenuId, $typeId, $checked)
    {
        if ($checked) {
            $this->addPermissoes($subMenuId, $typeId);
        } else {
            $this->remPermissoes($subMenuId, $typeId);
        }
    }

    public function render()
    {
        return view('livewire.submenu.permissoes');
    }
}
