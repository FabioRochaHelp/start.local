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
    public $subMenuName;
    public $name;
    public $url;
    public $direct = true;
    public $subMenuId;
    public $menuId;
    public $icon;
    public $editing = false;

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

        $this->dispatch('toast', [
            'message' => 'Permissões salvas com sucesso!',
            'type' => 'success',
        ]);
        $this->reset(['menu', 'subMenu', 'type']);
        $this->subMenus = $this->menu ? $this->menu->subMenus : [];
        $this->subMenuUsersTypes = SubMenuUsersType::where('sub_menu_id', $this->subMenu)->get();
        $this->dispatch('refreshSubMenuList');
    }

    public function createSubmenu()
    {
        $this->validate([
            'subMenuName' => [
                'required'
            ],
            'url' => [
                'required'
            ],
        ]);

        SubMenu::updateOrCreate(
            [
                'id' => $this->subMenuId,
            ],

            [
                'name' => $this->subMenuName,
                'url' => $this->url,
                'icon' => $this->icon,
                'menu_id' => $this->menuId,
                'direct' => $this->direct
            ],
        );

        $message = $this->subMenuId ? 'Submenu atualizado com sucesso!' : 'Submenu criado com sucesso!';

        $this->dispatch('toast', [
            'message' => $message,
            'type' => 'success',
        ]);

        $this->reset(['subMenuName', 'url', 'icon']);
        $this->menus = $this->getMenus();
        $this->subMenus = $this->menu ? $this->menu->subMenus : [];
        $this->menuId = $this->menu ? $this->menu->id : null;

        $this->dispatch('closeModal', id: 'report1');
    }

    public function edit($id)
    {
        $subMenu = SubMenu::with('menu')->find($id);
        $this->subMenuId = $subMenu->id;
        $this->menu = $subMenu->menu;
        $this->subMenuName = $subMenu->name;
        $this->url = $subMenu->url;
        $this->icon = $subMenu->icon;
        $this->menuId = $subMenu->menu_id;
        $this->direct = $subMenu->direct;
        $this->editing = true;

        $this->dispatch('openModal', id: 'report1');
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
