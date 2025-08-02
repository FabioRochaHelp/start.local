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
                        <li class="breadcrumb-item"> Instituição </li>
                        <li class="breadcrumb-item active" aria-current="page">Listar</li>
                    </ol>
                </nav>
                <div class="ms-panel">
                    <div class="ms-panel-header ms-panel-custome">
                        <h6>Lista de Instituições</h6>
                        <a href="{{ route('institution.register.view') }}" class="ms-text-primary">Adicionar
                            Instituição</a>
                    </div>
                    <div class="ms-panel-body">
                        <div class="table-responsive">
                            @if ($institutions->count() == 0)
                                Nenhuma instituição cadastrada
                            @else
                                <table class="table table-striped thead-primary w-100">
                                    <th>Tenancy</th>
                                    <th>Nome</th>
                                    <th>CNPJ</th>
                                    <th>E-mail</th>
                                    <th>Telefone</th>
                                    <th>Responsabilidade</th>
                                    <th>CPF</th>
                                    <th>Criada em</th>
                                    <th>Ações</th>
                                    @foreach ($institutions as $institution)
                                        <tr>
                                            <td>{{ $institution->tenant_id }}</td>
                                            <td>{{ $institution->name }}</td>
                                            <td>{{ formatarCNPJ($institution->cnpj) }}</td>
                                            <td>{{ $institution->email }}</td>
                                            <td>{{ $institution->phone ? formatarCelular($institution->phone) : 'Celular não informado' }}
                                            </td>
                                            <td>{{ $institution->responsability }}</td>
                                            <td>{{ $institution->cpf ? formatarCPF($institution->cpf) : 'CPF não informado' }}
                                            </td>
                                            <td>{{ $institution->created_at->format('d/m/Y') }}</td>
                                            <td>
                                                <a
                                                    href="{{ route('institution.edit.view', ['id' => $institution->id]) }}">
                                                    <button type="button" class="ms-btn-icon"
                                                        style="background-color: #00acb1;" name="button"><i
                                                            class="material-icons"
                                                            style="font-size: 18px; margin-left: 8px;">edit</i></button>
                                                </a>
                                                <a href="{{ route('institution.delete', ['id' => $institution->id]) }}">
                                                    <button type="button" class="ms-btn-icon"
                                                        style="background-color: #dc3545;" name="button"><i
                                                            class="material-icons"
                                                            style="font-size: 18px; margin-left: 8px;">delete</i></button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                            @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
