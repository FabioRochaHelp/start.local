<div class="ms-aside-overlay ms-overlay-left ms-toggler" data-bs-target="#ms-side-nav" data-bs-toggle="slideLeft"></div>
<div class="ms-aside-overlay ms-overlay-right ms-toggler" data-bs-target="#ms-recent-activity" data-bs-toggle="slideRight">
</div>
<aside id="ms-side-nav" class="side-nav fixed ms-aside-scrollable ms-aside-left">
    <!-- Logo -->
    <div class="logo-sn ms-d-block-lg">
        @php
            if (auth()->user()->tenant_id) {
                $institution = \App\Models\Institution::where('tenant_id', auth()->user()->tenant_id)->first();

                if ($institution->image) {
                    $logoPath = tenant_asset($institution->image);
                }

                if (auth()->user()->image) {
                    $avatarPath = tenant_asset(auth()->user()->image);
                } else {
                    $avatarPath = null;
                }
            }
        @endphp

        <a class="ps-0 ms-0 text-center" href="{{ route('home.view') }}"> <img
                src="{{ $logoPath ?? asset('landpage/img/logo-light.png') }}" alt="logo"></a>

        <a href="#" class="text-center ms-logo-img-link"> <img src="{{ $avatarPath ?? '/default-avatar.png' }}"
                alt="avatar"></a>
        <h5 class="text-center text-white mt-2">{{ strtok(auth()->user()->name, '') }}</h5>
        <h6 class="text-center text-white mb-3">{{ auth()->user()->access_level }}</h6>
    </div>
    <!-- Navigation -->
    <ul class="accordion ms-main-aside fs-14" id="side-nav-accordion">
        <!-- Home -->
        @can('show_home')
            <li class="menu-item">
                <a href="/dashboard">
                    <span><i class="fa fa-home"></i>Inicio</span>
                </a>
            </li>
        @endcan
        {{-- @can('show_home')
            <li class="menu-item">
                <a href="/sensor">
                    <span><i class="fa fa-home"></i>Sensor de ambiente</span>
                </a>
            </li>
        @endcan --}}
        <!-- Management -->
        @canany(['list_institution', 'add_institution', 'add_topograph', 'list_topograph', 'list_user', 'add_user',
            'list_role', 'add_role'])
            <li class="menu-item">
                <a href="#" class="has-chevron" data-bs-toggle="collapse" data-bs-target="#manage"
                    aria-expanded="false" aria-controls="manage">
                    <span><i class="fa fa-cogs"></i>Gerenciamento</span>
                </a>
                <ul id="manage" class="collapse" aria-labelledby="manage" data-bs-parent="#side-nav-accordion">
                    @canany('list_institution', 'add_institution')
                        <li class="menu-item">
                            <a href="#" class="has-chevron" data-bs-toggle="collapse" data-bs-target="#institution"
                                aria-expanded="false" aria-controls="institution">Instituição</a>
                            @can('add_institution')
                                <ul id="institution" class="collapse" aria-labelledby="institution" data-bs-parent="#manage">
                                    <li><a href="{{ route('institution.register.view') }}">Adicionar Instituição</a></li>
                                </ul>
                            @endcan
                            @can('list_institution')
                                <ul id="institution" class="collapse" aria-labelledby="institution" data-bs-parent="#manage">
                                    <li><a href="{{ route('institution.list.view') }}">Listar Instituições</a></li>
                                </ul>
                            @endcan
                        </li>
                    @endcanany
                    @canany('add_topograph', 'list_topograph')
                        <li class="menu-item">
                            <a href="#" class="has-chevron" data-bs-toggle="collapse" data-bs-target="#topography"
                                aria-expanded="false" aria-controls="topography">Topografia</a>
                            @can('add_topograph')
                                <ul id="topography" class="collapse" aria-labelledby="topography" data-bs-parent="#manage">
                                    <li><a href="{{ route('topography.register.view') }}">Adicionar Topografia</a></li>
                                </ul>
                            @endcan
                            @can('list_topograph')
                                <ul id="topography" class="collapse" aria-labelledby="topography" data-bs-parent="#manage">
                                    <li><a href="{{ route('topography.list.view') }}">Listar Topografia</a></li>
                                </ul>
                            @endcan
                        </li>
                    @endcanany
                    @canany('add_unity', 'list_unity')
                        <li class="menu-item">
                            <a href="#" class="has-chevron" data-bs-toggle="collapse" data-bs-target="#unity"
                                aria-expanded="false" aria-controls="unity">Unidade</a>
                            @can('add_unity')
                                <ul id="unity" class="collapse" aria-labelledby="unity" data-bs-parent="#manage">
                                    <li><a href="{{ route('unity.register.view') }}">Adicionar Unidade</a></li>
                                </ul>
                            @endcan
                            @can('list_unity')
                                <ul id="unity" class="collapse" aria-labelledby="unity" data-bs-parent="#manage">
                                    <li><a href="{{ route('unity.list.view') }}">Listar Unidade</a></li>
                                </ul>
                            @endcan
                        </li>
                    @endcanany
                    @canany('add_role', 'list_role')
                        <li class="menu-item">
                            <a href="#" class="has-chevron" data-bs-toggle="collapse" data-bs-target="#permissions"
                                aria-expanded="false" aria-controls="permissions">Tipo de Usuários</a>
                            @can('add_role')
                                <ul id="permissions" class="collapse" aria-labelledby="permissions" data-bs-parent="#permissions">
                                    <li> <a href="{{ route('role.add.view') }}">Adicionar Tipo de Usuário</a></li>
                                </ul>
                            @endcan
                            @can('list_role')
                                <ul id="permissions" class="collapse" aria-labelledby="permissions"
                                    data-bs-parent="#permissions">
                                    <li> <a href="{{ route('role.list.view') }}">Listar Tipo de Usuários</a></li>
                                </ul>
                            @endcan
                        </li>
                    @endcanany
                    @canany('add_user', 'list_user')
                        <li class="menu-item">
                            <a href="#" class="has-chevron" data-bs-toggle="collapse" data-bs-target="#users"
                                aria-expanded="false" aria-controls="users">Usuário</a>
                            @can('add_user')
                                <ul id="users" class="collapse" aria-labelledby="users" data-bs-parent="#users">
                                    <li> <a href="{{ route('user.register.view') }}">Adicionar Usuário</a></li>
                                </ul>
                            @endcan
                            @can('list_user')
                                <ul id="users" class="collapse" aria-labelledby="users" data-bs-parent="#users">
                                    <li> <a href="{{ route('user.list.view') }}">Listar Usuários</a></li>
                                </ul>
                            @endcan
                        </li>
                    @endcanany
                    @canany('add_surgery', 'list_surgery')
                        <li class="menu-item">
                            <a href="#" class="has-chevron" data-bs-toggle="collapse" data-bs-target="#surgery"
                                aria-expanded="false" aria-controls="surgery">Cirurgias</a>
                            @can('add_user')
                                <ul id="surgery" class="collapse" aria-labelledby="surgery" data-bs-parent="#surgery">
                                    <li> <a href="{{ route('surgery.register') }}">Adicionar Cirurgia</a></li>
                                </ul>
                            @endcan
                            @can('list_user')
                                <ul id="surgery" class="collapse" aria-labelledby="surgery" data-bs-parent="#surgery">
                                    <li> <a href="{{ route('surgery.list') }}">Listar Cirurgias</a></li>
                                </ul>
                            @endcan
                        </li>
                    @endcanany
                    @canany('add_user', 'list_user')
                        <li class="menu-item">
                            <a href="#" class="has-chevron" data-bs-toggle="collapse" data-bs-target="#secretaria"
                                aria-expanded="false" aria-controls="secretaria">Secretarias</a>
                            @can('add_user')
                                <ul id="secretaria" class="collapse" aria-labelledby="secretaria" data-bs-parent="#secretaria">
                                    <li> <a href="{{ route('secretaria.create') }}">Adicionar Secretaria</a></li>
                                </ul>
                            @endcan
                            @can('list_user')
                                <ul id="secretaria" class="collapse" aria-labelledby="secretaria" data-bs-parent="#secretaria">
                                    <li> <a href="{{ route('secretaria.index') }}">Listar Secretarias</a></li>
                                </ul>
                            @endcan
                        </li>
                    @endcanany
                    @canany('add_user', 'list_user')
                    <li class="menu-item">
                        <a href="#" class="has-chevron" data-bs-toggle="collapse" data-bs-target="#agravo"
                            aria-expanded="false" aria-controls="agravo">Doença ou Agravo</a>
                        @can('add_user')
                            <ul id="agravo" class="collapse" aria-labelledby="agravo" data-bs-parent="#agravo">
                                <li> <a href="{{ route('agravo.create') }}">Adicionar</a></li>
                            </ul>
                        @endcan
                        @can('list_user')
                            <ul id="agravo" class="collapse" aria-labelledby="agravo" data-bs-parent="#agravo">
                                <li> <a href="{{ route('agravo.index') }}">Listar</a></li>
                            </ul>
                        @endcan
                    </li>
                    @canany('add_role', 'list_role')
                    <li>
                        <a href="{{ route('log.index') }}" class="">
                            <span class="text-dark">Logs de acesso</span>
                        </a>
                    </li>
                @endcan
                @endcanany
                </ul>
            </li>
        @endcanany
        @canany('add_doctor', 'list_doctor')
            <li class="menu-item">
                <a href="#" class="has-chevron" data-bs-toggle="collapse" data-bs-target="#doctors"
                    aria-expanded="false" aria-controls="manage_doctors">
                    <span><i class="fa fa-user-md"></i>Médicos</span>
                </a>
                <ul id="doctors" class="collapse" aria-labelledby="manage_doctors"
                    data-bs-parent="#side-nav-accordion">
                    @can('add_doctor')
                        <li><a href="{{ route('doctor.register.view') }}">Adicionar Médicos</a></li>
                    @endcan
                    @can('list_doctor')
                        <li><a href="{{ route('doctor.list.view') }}">Listar Médicos</a></li>
                    @endcan
                </ul>
            </li>
        @endcanany

        @canany('add_doctor', 'list_doctor')
            <li class="menu-item">
                <a href="#" class="has-chevron" data-bs-toggle="collapse" data-bs-target="#patient"
                    aria-expanded="false" aria-controls="manage_patient">
                    <span><i class="fa fa-user"></i>Pacientes</span>
                </a>
                <ul id="patient" class="collapse" aria-labelledby="manage_patient"
                    data-bs-parent="#side-nav-accordion">
                    @can('add_doctor')
                        <li><a href="{{ route('patient.register.view') }}">Adicionar Pacientes</a></li>
                    @endcan
                    @can('list_doctor')
                        <li><a href="{{ route('patient.list.view') }}">Listar Pacientes</a></li>
                    @endcan
                </ul>
            </li>
        @endcanany
        @canany('list_indicator', 'list_iras')
            <li class="menu-item">
                <a href="#" class="has-chevron" data-bs-toggle="collapse" data-bs-target="#scih"
                    aria-expanded="false" aria-controls="manage_scih">
                    <span><i class="fa fa-clipboard"></i>Indicadores</span>
                </a>
                <ul id="scih" class="collapse" aria-labelledby="manage_doctors"
                    data-bs-parent="#side-nav-accordion">
                    <li><a href="{{ route('indicator.list.view') }}"> Assistenciais</a></li>
                    <li><a href="{{ route('indicator-audit.list') }}"> Auditoria</a></li>
                    <li><a href="{{ route('indicator-insumo.list.view') }}">Insumos</a></li>
                </ul>
            </li>
        @endcanany
        @canany('list_indicator', 'list_iras')
            <li class="menu-item">
                <a href="#" class="has-chevron" data-bs-toggle="collapse" data-bs-target="#antibiotico"
                    aria-expanded="false" aria-controls="manage_antibiotico">
                    <span><i class="fa fa-medkit"></i>Antibióticos</span>
                </a>
                <ul id="antibiotico" class="collapse" aria-labelledby="manage_doctors"
                    data-bs-parent="#side-nav-accordion">
                    <li><a href="{{ route('antibiotico.list') }}"> Importar dados</a></li>
                    <li><a href="{{ route('antibiotico.unitario') }}"> Preço Unitário</a></li>
                    <li class="menu-item">
                        <a href="#" class="has-chevron" data-bs-toggle="collapse"
                            data-bs-target="#anti-relatorios" aria-expanded="false"
                            aria-controls="anti-relatorios">Relatórios</a>
                        <ul id="anti-relatorios" class="collapse" aria-labelledby="anti-relatorios"
                            data-bs-parent="#manage">
                            <li><a href="{{ route('antibiotico.custo') }}"> Custos</a></li>
                        </ul>
                        <ul id="anti-relatorios" class="collapse" aria-labelledby="institution"
                            data-bs-parent="#manage">
                            <li><a href="{{ route('antibiotico.grafico') }}"> Gráficos</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
        @endcanany
        @canany('list_indicator', 'list_iras')
            <li class="menu-item">
                <a href="#" class="has-chevron" data-bs-toggle="collapse" data-bs-target="#microorganismo"
                    aria-expanded="false" aria-controls="manage_microorganismo">
                    <span><i class="fa fa-microscope"></i>Microorganismos</span>
                </a>
                <ul id="microorganismo" class="collapse" aria-labelledby="manage_microorganismo"
                    data-bs-parent="#side-nav-accordion">
                    <li><a href="{{ route('cultura.list') }}"> Culturas</a></li>
                    <li><a href="{{ route('cultura.result') }}"> Resultados</a></li>
                </ul>
            </li>
        @endcanany
        @canany('list_indicator', 'list_iras')
            <li class="menu-item">
                <a href="#" class="has-chevron" data-bs-toggle="collapse" data-bs-target="#notify"
                    aria-expanded="false" aria-controls="manage_notify">
                    <span><i class="fa fa-exclamation-triangle"></i>Notificações</span>
                </a>
                <ul id="notify" class="collapse" aria-labelledby="manage_doctors"
                    data-bs-parent="#side-nav-accordion">
                    <li><a href="{{ route('notify.list') }}"> Assistenciais</a></li>
                    <li><a href="{{ route('compulsoria.create') }}">Compulsórias</a></li>
                    <li><a href="{{ route('iras.list.view') }}">IRAS Geral</a></li>
                    <li><a href="{{ route('irassurgery.list.view') }}">IRAS Cirúrgica</a></li>
                </ul>
            </li>
        @endcanany

        @can('access')
            <li class="menu-item">
                <a href="#" class="has-chevron" data-bs-toggle="collapse" data-bs-target="#protocol"
                    aria-expanded="false" aria-controls="manage_protocol">
                    <span><i class="fa fa-book"></i>Protocolos</span>
                </a>
                <ul id="protocol" class="collapse" aria-labelledby="manage_protocol"
                    data-bs-parent="#side-nav-accordion">
                    @can('add_protocol')
                        <li><a href="{{ route('protocol.create') }}">Adicionar Protocolos</a></li>
                    @endcan
                    @can('list_protocol')
                        <li><a href="{{ route('protocol.list') }}">Listar Protocolos</a></li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('access')
            <li class="menu-item">
                <a href="#" class="has-chevron" data-bs-toggle="collapse" data-bs-target="#training"
                    aria-expanded="false" aria-controls="training">
                    <span><i class="fa fa-recycle"></i>Treinamentos</span>
                </a>
                <ul id="training" class="collapse" aria-labelledby="training" data-bs-parent="#side-nav-accordion">
                    <li class="menu-item">
                        <a href="{{ url('training') }}">Meus Cursos</a>
                    </li>
                   @can('moodle_admin')
                        <li class="menu-item">
                            <a href="{{ route('getallcourses') }}">Todos os Cursos</a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @canany('analytics_graph', 'analytics_table')
            <li class="menu-item">
                <a href="#" class="has-chevron" data-bs-toggle="collapse" data-bs-target="#analytics"
                    aria-expanded="false" aria-controls="analytics">
                    <span><i class="fa fa-chart-bar"></i>Analytics</span>
                </a>
                <ul id="analytics" class="collapse" aria-labelledby="analytics" data-bs-parent="#side-nav-accordion">
                    @can('analytics_graph')
                        <li><a href="{{ route('analytics.graph') }}">Graficos</a></li>
                    @endcan
                    @can('analytics_table')
                        {{-- <li><a href="{{ route('analytics.table') }}">Tabelas</a></li> --}}
                        <li><a href="{{ route('indicator.report') }}"> Relatórios</a></li>
                    @endcan
                </ul>
            </li>
        @endcanany
        <!-- /Management -->
        <!-- /Advanced UI Elements -->
    </ul>
</aside>
