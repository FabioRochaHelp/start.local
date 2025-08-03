<x-layout title='Adicionar Usuário'>
    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb ps-0">
                        <li class="breadcrumb-item"><i class="material-icons">home</i> <a
                            href="{{ route('home.view') }}">Home</a> </li>
                        <li class="breadcrumb-item"> Gerenciamento </li>
                        <li class="breadcrumb-item"> Usuário </li>
                        <li class="breadcrumb-item active" aria-current="page">Perfil</li>
                    </ol>
                </nav>
            </div>
            <div class="col-xl-12 col-md-12">
                <div class="ms-panel">
                    <div class="ms-panel-header ms-panel-custome">
                        <a href="{{ route('user.edit.view', ['id'=>$user->id]) }}" class="ms-text-primary">Editar Perfil</a>
                        <a href="{{ route('user.list.view') }}" class="ms-text-primary">Lista de Usuários</a>
                    </div>
                    <div class="ms-panel-body">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="validationCustom001">Nome</label>
                                <p>{{ $user->name }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom002">CPF</label>
                                <p>{{ $user->cpf }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label id="validationCustom003">Idade</label>
                                <p>{{ $user->age }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Sexo</label>
                                <p>{{ $user->gender }}</p>
                            </div>
                        </div>
                        @if ($user->collaborator != null)
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom006">Cargo</label>
                                    <p>{{ $user->collaborator->job_role }}</p>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="validationCustom007">Departamento</label>
                                    <p>{{ $user->collaborator->department }}</p>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom006">Cargo</label>
                                    <p> - </p>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="validationCustom007">Departamento</label>
                                    <p> - </p>
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom004">Email</label>
                                <p>{{ $user->email }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom010">Telefone</label>
                                <p>{{ $user->phone }}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-6 col-md-12">
                                <div class="ms-panel">
                                    <div class="ms-panel-header">
                                        <h6>Histórico de Treinamentos</h6>
                                    </div>
                                    <div class="ms-panel-body">
                                        <div class="table-responsive">
                                            
                                            @if ($history->count() == 0)
                                                <div class="ms-panel-header">
                                                    Nenhuma Treinamento encontrado
                                                </div>
                                            @else
                                                <table class="table table-striped thead-primary w-100">
                                                    <th>Treinamentos</th>
                                                    <th>Acessar</th>
                                                    @foreach ($history as $item)
                                                        <tr>
                                                            <td>{{ $item['fullname'] }}</td>
                                                            <td>
                                                                <a href="{{ $item['viewurl'] }}">
                                                                    <button type="button" class="ms-btn-icon" style="background-color: #00acb1;" name="button"><i class="material-icons" style="font-size: 18px; margin-left: 8px;">arrow_outward</i></button>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-md-12">
                                <div class="ms-panel">
                                    <div class="ms-panel-header">
                                        <h6>Permissões de {{ $user->role->name }}</h6>
                                    </div>
                                    <div class="ms-panel-body">
                                        <div class="table-responsive">
                                            @if ($abilities->count() == 0)
                                                <div class="ms-panel-header">
                                                    Nenhuma permissão encontrada
                                                </div>
                                            @else
                                                <table class="table table-striped thead-primary w-100">
                                                    <th>Permissões</th>
                                                    @foreach ($abilities as $ability)
                                                        <tr>
                                                            <td>{{ $ability->name ?? '-'}}</td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('user.list.view') }}" class="btn btn-warning">Voltar</a>
                        <a href="{{ route('user.edit.view', ['id'=>$user->id]) }}" class="btn btn-primary">Editar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>