<x-layout title="Pessoas">
    <div class="ms-content-wrapper">
        <div class="row">
           
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb ps-0">
                        <li class="breadcrumb-item"><i class="fa fa-chart-bar"></i> <a
                                href="{{ route('home.view') }}">Dashboard</a> </li>
                        <li class="breadcrumb-item"> Cadastros </li>
                        <li class="breadcrumb-item"><a href="{{ route('pessoas.index') }}">Pessoas</a></li>
                    </ol>
                </nav>
              
                <livewire:pessoas.table />
            </div>
        </div>
    </div>
   
</x-layout>
