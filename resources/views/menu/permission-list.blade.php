<x-layout title='Adicionar Usuário'>
    <!-- Body Content Wrapper -->
    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-md-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb ps-0">
                        <li class="breadcrumb-item"><i class="material-icons">home</i> <a
                            href="{{ route('home.view') }}">Home</a> </li>
                        <li class="breadcrumb-item"> Gerenciamento </li>
                        <li class="breadcrumb-item"> Usuário </li>
                        <li class="breadcrumb-item active" aria-current="page">Permissões</li>
                    </ol>
                </nav>
                <div class="ms-panel">
                    <div class="ms-panel-header ms-panel-custome">
                        <h6>Lista de Usuários e suas permissões</h6>
                    </div>
                    <div class="ms-panel-body">
                        <div class="table-responsive">
                            @if ($users->count() == 0)
                                Nenhum usuário cadastrado
                            @else
                                <table class="table table-striped thead-primary w-100">
                                    <th>ID Instituição</th>
                                    <th>Nome</th>
                                    <th>CPF</th>
                                    <th>Email</th>
                                    <th>Telefone</th>
                                    <th>Ações</th>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->tenant_id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->cpf }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>
                                                <label class="ms-switch">
                                                    <input type="checkbox"
                                                        {{ $user->access_level == 'admin' ? 'checked=""' : '' }}>
                                                    <span class="ms-switch-slider ms-switch-success round permission"
                                                        id="{{ $user->id }}"></span>
                                                </label>
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
<script>
    $(document).ready(function() {

        $('.permission').on('click', function(e) {
            var id = $(this).attr('id');
            $.ajax({
                type: 'GET',
                url: '{{ route('setpermission', ['id' => ':id']) }}'.replace(':id', id),
                dataType: 'json',
                success: function(retorno) {
                    console.log(retorno);
                },
                error: function(erro, er) {
                    // Se houver um erro durante o processamento, exibe a mensagem na div correspondente                       
                    $('#msg').html('Erro ' + erro.status + ' - ' + erro.statusText +
                        '</br> Tipo de erro: ' + er);
                    $("#msg").show();
                }
            });
        });

    });

</script>
