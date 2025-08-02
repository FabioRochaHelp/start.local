<!-- Exemplo de como usar os menus na view -->
@if(isset($menus) && $menus->count() > 0)
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <ul class="navbar-nav">
                @foreach($menus as $menu)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown{{ $menu->id }}" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            @if($menu->icon)
                                <i class="{{ $menu->icon }}"></i>
                            @endif
                            {{ $menu->name }}
                        </a>
                        
                        @if($menu->subMenus && $menu->subMenus->count() > 0)
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown{{ $menu->id }}">
                                @foreach($menu->subMenus as $subMenu)
                                    <li>
                                        <a class="dropdown-item" href="{{ $subMenu->url }}">
                                            @if($subMenu->icon)
                                                <i class="{{ $subMenu->icon }}"></i>
                                            @endif
                                            {{ $subMenu->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </nav>
@endif 