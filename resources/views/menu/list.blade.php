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
                        <li class="breadcrumb-item"><a href="{{ route("menu") }}">Permissões</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Menus</li>
                    </ol>
                </nav>
               
                @livewire('menu.permissoes', ['menus' => $menus ?? null, 'menu' => $menu ?? null])
            </div>
        </div>
    </div>
</x-layout>