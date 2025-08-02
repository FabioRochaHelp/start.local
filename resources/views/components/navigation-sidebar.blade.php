<div class="ms-aside-overlay ms-overlay-left ms-toggler" data-bs-target="#ms-side-nav" data-bs-toggle="slideLeft"></div>
<div class="ms-aside-overlay ms-overlay-right ms-toggler" data-bs-target="#ms-recent-activity" data-bs-toggle="slideRight">
</div>
<aside id="ms-side-nav" class="side-nav fixed ms-aside-scrollable ms-aside-left">
    <!-- Logo -->
    <div class="logo-sn ms-d-block-lg">
        <a class="ps-0 ms-0 text-center" href="{{ route('home.view') }}"> <img
                src="{{ $logoPath ?? asset('landpage/img/logo-light.png') }}" alt="logo"></a>

        <a href="#" class="text-center ms-logo-img-link"> <img src="{{ $avatarPath ?? '/default-avatar.png' }}"
                alt="avatar"></a>
        <h5 class="text-center text-white mt-2">{{ strtok(auth()->user()->name, '') }}</h5>
        <h6 class="text-center text-white mb-3">{{ auth()->user()->access_level }}</h6>
    </div>
    <!-- Navigation -->
    <ul class="accordion ms-main-aside fs-14" id="side-nav-accordion">
        <li class="menu-item">
            <a href="/dashboard">
                <span><i class="fa fa-home"></i>Início</span>
            </a>
        </li>
        <li class="menu-item">

            <a href="#" class="has-chevron" data-bs-toggle="collapse" data-bs-target="#manage"
                aria-expanded="false" aria-controls="manage">
                <span><i class="fa fa-cogs"></i>Configurações</span>
            </a>
            <ul id="manage" class="collapse" aria-labelledby="manage" data-bs-parent="#side-nav-accordion">
                <li class="menu-item">
                    <a href="#" class="has-chevron" data-bs-toggle="collapse" data-bs-target="#institution"
                        aria-expanded="false" aria-controls="institution">Instituição</a>

                    <ul id="institution" class="collapse" aria-labelledby="institution" data-bs-parent="#manage">
                        <li><a href="{{ route('institution.register.view') }}">Adicionar Instituição</a></li>
                    </ul>
                    <ul id="institution" class="collapse" aria-labelledby="institution" data-bs-parent="#manage">
                        <li><a href="{{ route('institution.list.view') }}">Listar Instituições</a></li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
  @if(isset($menus) && $menus->count() > 0)
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
@endif 
</aside>
