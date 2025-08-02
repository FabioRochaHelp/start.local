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
                        <a href="{{ route("user.register.view") }}" class="ms-text-primary">Adicionar Usuário</a>
                     </div>
                     <div class="ms-panel-body">
                        <div class="table-responsive">
                           @if($users->count() == 0)
                              Nenhum usuário cadastrado
                           @else
                              <table class="table table-striped thead-primary w-100">
                                 <th>Tipo</th>
                                 <th>Nome</th>
                                 <th>CPF</th>
                                 <th>Idade</th>
                                 <th>Cargo</th>
                                 <th>Departamento</th>
                                 <th>Email</th>
                                 <th>Telefone</th>
                                 <th>Id Instituição</th>
                                 <th>Adicionado</th>
                                 <th>Atualizado</th>
                                 <th>Ações</th>
                           @foreach ($users as $user)
                                 <tr>
                                    <td>{{ $user->user_type_id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->cpf }}</td>
                                    <td>{{ $user->age }}</td>
                                    {{-- <td>{{ $user->collaborator->job_role }}</td> --}}
                                    {{-- <td>{{ $user->collaborator->departament }}</td> --}}
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->institution_id }}</td>
                                    <td>{{ $user->created_at}}</td>
                                    <td>{{ $user->updated_at}}</td>
                                    <td>
                                       <a href="/user/edit/{{$user->id}}">
                                          <button type="button" class="ms-btn-icon" style="background-color: #00acb1;" name="button"><i class="material-icons" style="font-size: 18px; margin-left: 8px;">edit</i></button>
                                       </a>
                                       <a href="/user/delete/{{$user->id}}">
                                          <button type="button" class="ms-btn-icon" style="background-color: #dc3545;" name="button"><i class="material-icons" style="font-size: 18px; margin-left: 8px;">delete</i></button>
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