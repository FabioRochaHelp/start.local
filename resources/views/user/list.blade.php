<x-layout title='Adicionar Usuário'>
    <!-- Body Content Wrapper -->
    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb ps-0">
                        <li class="breadcrumb-item"><i class="material-icons">home</i> <a
                                href="{{ route('home.view') }}">Home</a> </li>
                        <li class="breadcrumb-item"> Gerenciamento </li>
                        <li class="breadcrumb-item"> Usuário </li>
                        <li class="breadcrumb-item active" aria-current="page">Listar</li>
                    </ol>
                </nav>
                <div class="ms-panel">
                    <div class="ms-panel-header ms-panel-custome">
                        <h6>Lista de Usuários</h6>
                        @if (Auth::user()->user_type_id == 1)
                              <a href="{{ route('user.register.view') }}" class="ms-text-primary">Adicionar Usuário</a>
                        @endif
                      
                    </div>
                    <div class="ms-panel-body">
                        <div class="table-responsive">
                            @if ($users->count() == 0)
                                Nenhum usuário cadastrado
                            @else
                                <table class="table table-striped thead-primary w-100">
                                    <th>Tipo</th>
                                    <th>Nome</th>
                                    <th>CPF</th>
                                    <th>Idade</th>
                                    <th>Email</th>
                                    <th>Telefone</th>
                                    <th>Adicionado</th>
                                    <th>Ações</th>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->userType->name ?? '' }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->cpf ? formatarCPF($user->cpf) : 'CPF não informado' }}
                                            <td>{{ $user->age }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone ? formatarCelular($user->phone) : 'Celular não informado' }}
                                            <td>{{ $user->created_at->format('d/m/Y') }}</td>
                                            <td>
                                                @if (auth()->user()->user_type_id == 1)
                                                    <a href="/user/edit/{{ $user->id }}">
                                                        <button type="button" class="ms-btn-icon"
                                                            style="background-color: #00acb1;" name="button"
                                                            title="Editar"><i class="material-icons"
                                                                style="font-size: 18px; margin-left: 8px;">edit</i></button>
                                                    </a>
                                                    <a href="/user/delete/{{ $user->id }}">
                                                        <button type="button" class="ms-btn-icon"
                                                            style="background-color: #dc3545;" name="button"
                                                            title="Excluir"><i class="material-icons"
                                                                style="font-size: 18px; margin-left: 8px;">delete</i></button>
                                                    </a>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
