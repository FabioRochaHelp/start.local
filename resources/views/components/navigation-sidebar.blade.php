<div class="ms-aside-overlay ms-overlay-left ms-toggler" data-bs-target="#ms-side-nav" data-bs-toggle="slideLeft">
</div>
<div class="ms-aside-overlay ms-overlay-right ms-toggler" data-bs-target="#ms-recent-activity" data-bs-toggle="slideRight">
</div>
<aside id="ms-side-nav" class="side-nav fixed ms-aside-scrollable ms-aside-left">
    <!-- Logo -->
    <div class="logo-sn ms-d-block-lg">
        <a class="ps-0 ms-0 text-center" href="{{ route('home.view') }}"> <img
                src="{{ $logoPath ?? asset('assets/img/medboard-logo-216x62.png') }}" alt="logo"></a>

        <a href="#" class="text-center ms-logo-img-link"> <img src="{{ $avatarPath ?? '/default-avatar.png' }}"
                alt="avatar"></a>
        <h5 class="text-center text-white mt-2">{{ strtok(auth()->user()->name, '') }}</h5>
        <h6 class="text-center text-white mb-3">{{ auth()->user()->access_level }}</h6>
    </div>
    <!-- Navigation -->
    <ul class="accordion ms-main-aside fs-14" id="side-nav-accordion">
        <li class="menu-item">
            <a href="/dashboard">
                <span><i class="fa fa-chart-bar"></i>Dashboard</span>
            </a>
        </li>
        @if (isset($menus) && $menus->count() > 0)
            @foreach ($menus as $menu)
                <li class="menu-item">
                    <a href="#" class="has-chevron" data-bs-toggle="collapse"
                        data-bs-target="#manage{{ $menu->id }}" aria-expanded="false"
                        aria-controls="manage{{ $menu->id }}">
                        <span>
                            @if ($menu->icon)
                                <i class="{{ $menu->icon }}"></i>
                            @endif
                            </i> {{ $menu->name }}
                        </span>
                    </a>
                    <ul id="manage{{ $menu->id }}" class="collapse list-unstyled">
                        @if ($menu->subMenus && $menu->subMenus->count() > 0)
                            @foreach ($menu->subMenus as $subMenu)
                                <li>
                                    <a href="{{ route($subMenu->url) }}">
                                        @if ($subMenu->icon)
                                            <i class="{{ $subMenu->icon }}"></i>
                                        @endif
                                        {{ $subMenu->name }}
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </li>
            @endforeach
        @endif
    </ul>
</aside>
