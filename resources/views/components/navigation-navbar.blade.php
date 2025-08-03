<nav class="navbar ms-navbar">
    <div class="ms-aside-toggler ms-toggler ps-0" data-bs-target="#ms-side-nav" data-bs-toggle="slideLeft">
        <span class="ms-toggler-bar bg-white"></span>
        <span class="ms-toggler-bar bg-white"></span>
        <span class="ms-toggler-bar bg-white"></span>
    </div>

    <div class="docfind-logo d-none d-xl-block">
        <a class="ps-0 ms-0 text-center" href="{{ route('home.view') }}"> <img src="{{ $logoPath ?? asset('assets/img/medboard-logo-216x62.png') }}" alt="logo"></a>
    </div>
    <div class="logo-sn logo-sm ms-d-block-sm">        
        <a class="ps-0 ms-0 text-center navbar-brand me-0" href="/"><img src="{{ $logoPath ?? asset('assets/img/medboard-logo-216x62.png') }}" alt="logo"></a>
    </div>
    <ul class="ms-nav-list ms-inline mb-0" id="ms-nav-options">

        <li class="ms-nav-item dropdown">
            <a href="#" class="text-disabled ms-has-notification" id="notificationDropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="material-icons"
                    style="font-size: 28px; color: white;">notifications</span></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown">
                <li class="dropdown-menu-header">
                    <h6 class="dropdown-header ms-inline m-0"><span class="text-disabled">Notificações</span></h6>
                    <span class="badge rounded-pill badge-info">4 novas</span>
                </li>
                {{-- <li class="dropdown-divider"></li>
                <li class="ms-scrollable ms-dropdown-list">
                    <a class="media p-2" href="#">
                        <div class="media-body">
                            <span>12 ways to improve your crypto dashboard</span>
                            <p class="fs-10 my-1 text-disabled"><i class="material-icons">access_time</i> 30 seconds ago
                            </p>
                        </div>
                    </a>
                    <a class="media p-2" href="#">
                        <div class="media-body">
                            <span>You have newly registered users</span>
                            <p class="fs-10 my-1 text-disabled"><i class="material-icons">access_time</i> 45 minutes ago
                            </p>
                        </div>
                    </a>
                    <a class="media p-2" href="#">
                        <div class="media-body">
                            <span>Your account was logged in from an unauthorized IP</span>
                            <p class="fs-10 my-1 text-disabled"><i class="material-icons">access_time</i> 2 hours ago
                            </p>
                        </div>
                    </a>
                    <a class="media p-2" href="#">
                        <div class="media-body">
                            <span>An application form has been submitted</span>
                            <p class="fs-10 my-1 text-disabled"><i class="material-icons">access_time</i> 1 day ago</p>
                        </div>
                    </a>
                </li>
                <li class="dropdown-divider"></li>
                <li class="dropdown-menu-footer text-center">
                    <a href="#">View all Notifications</a>
                </li> --}}
            </ul>
        </li>
        <li class="ms-nav-item ms-nav-user dropdown">
            <a href="#" id="userDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="ms-user-img ms-img-round float-end" src="{{ $avatarPath ?? "/default-avatar.png" }}" alt="avatar"> </a>
            <ul class="dropdown-menu dropdown-menu-end user-dropdown" aria-labelledby="userDropdown">
                <li class="dropdown-menu-header">
                    <h6 class="dropdown-header ms-inline m-0"><span class="text-disabled">Bem vindo, {{ auth()->user()->name }}</span>
                    </h6>
                </li>
                <li class="dropdown-divider"></li>
                <li class="ms-dropdown-list">
                    <a class="media fs-14 p-2" href="{{ route('user.profile.view',['id'=>Auth::user()->id]) }}"> <span><i
                                class="flaticon-user me-2"></i> Perfil</span> </a>
                    <!--<a class="media fs-14 p-2" href="pages/apps/email.html"> <span><i class="flaticon-mail me-2"></i>
                            Inbox</span> <span class="badge rounded-pill badge-info">3</span> </a>
                    <a class="media fs-14 p-2" href="pages/prebuilt-pages/user-profile.html"> <span><i
                                class="flaticon-gear me-2"></i> Account Settings</span> </a>
                </li>
                <li class="dropdown-divider"></li>
                <li class="dropdown-menu-footer">
                    <a class="media fs-14 p-2" href="pages/prebuilt-pages/lock-screen.html"> <span><i
                                class="flaticon-security me-2"></i> Lock</span> </a>-->
                </li>
                <li class="dropdown-menu-footer">
                    <a class="media fs-14 p-2" href="{{ route('logout') }}"> <span><i
                                class="flaticon-shut-down me-2"></i> Sair</span> </a>
                </li>
            </ul>
        </li>
    </ul>
    <div class="ms-toggler ms-d-block-sm pe-0 ms-nav-toggler" data-bs-toggle="slideDown"
        data-bs-target="#ms-nav-options">
        <span class="ms-toggler-bar bg-white"></span>
        <span class="ms-toggler-bar bg-white"></span>
        <span class="ms-toggler-bar bg-white"></span>
    </div>
</nav>
