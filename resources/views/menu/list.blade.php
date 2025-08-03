<x-layout title='Adicionar Usuário'>
    <!-- Body Content Wrapper -->
    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb ps-0">
                        <li class="breadcrumb-item"><i class="fa fa-chart-bar"></i> <a
                            href="{{ route('home.view') }}">Dashboard</a> </li>
                        <li class="breadcrumb-item"> Configurações </li>
                        <li class="breadcrumb-item"> Permissões </li>
                        <li class="breadcrumb-item active" aria-current="page">Menus</li>
                    </ol>
                </nav>
                <div class="ms-panel">
                    <div class="ms-panel-header ms-panel-custome">
                        <h6>Lista de Menus</h6>
                            <a href="{{ route("user.register.view") }}" class="ms-text-primary">Adicionar Menu</a>
                    </div>
                    @livewire('menu.permissoes', ['menus' => $menus ?? null, 'menu' => $menu ?? null])
                </div>
            </div>
        </div>
    </div>
</x-layout>