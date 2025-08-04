<div>
    <div class="ms-panel">
        <div class="ms-panel-header ms-panel-custome">
            <h6>Lista de Submenus - {{ $menu->name }}</h6>
            <!-- Botão para abrir o modal -->
  
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#report1">
                Adicionar Submenu
            </button>
  

        </div>
        <div class="ms-panel-body">
            <div class="table-responsive">
                <table class="table table-striped thead-primary">
                    <th>Ícone</th>
                    <th>Submenu</th>
                    <th>Rota</th>
                    @foreach ($types as $type)
                        <th>{{ $type->name }}</th>
                    @endforeach
                    @if ($menus->count() == 0)
                        Nenhum menu cadastrado
                    @else
                        @foreach ($subMenus as $subMenu)
                            <tr>
                                <td> <i class="{{ $subMenu->icon }}"></i> </td>
                                <td>{{ $subMenu->name }}

                                    <div class="dropdown float-end">
                                        <a href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="material-icons">more_vert</i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li class="ms-dropdown-list">
                                                <a class="media p-2" href="#">
                                                    <div class="media-body">
                                                        <span>Editar</span>
                                                    </div>
                                                </a>
                                                <a class="media p-2" href="#">
                                                    <div class="media-body">
                                                        <span>Desativar</span>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                                <td>{{ $subMenu->route }}</td>

                                @foreach ($types as $type)
                                    <td>
                                        <div class="form-check">
                                            <label class="ms-switch">
                                                <input type="checkbox"
                                                    {{ $subMenu->hasPermission($type->id) ? 'checked' : '' }}
                                                    wire:click="togglePermissao({{ $subMenu->id }}, {{ $type->id }}, $event.target.checked)">
                                                <span class="ms-switch-slider ms-switch-danger round"></span>
                                            </label>

                                        </div>
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    @endif
                </table>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="report1" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog ms-modal-dialog-width">
            <div class="modal-content ms-modal-content-width">
                <div class="modal-header ms-modal-header-radius-0">
                    <h4 class="modal-title text-white">Adicionar Submenu</h4>
                    <button type="button" class="close text-white" data-bs-dismiss="modal"
                        aria-hidden="true">×</button>
                </div>

                <div class="modal-body p-0 text-start">
                    <div class="col-xl-12 col-md-12">
                        <div class="ms-panel ms-panel-bshadow-none">
                            <div class="ms-panel-header">
                                <h6>Informações do Submenu</h6>
                            </div>
                            <div class="ms-panel-body">
                                <form wire:submit.prevent="save">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="submenuName">Nome do Submenu</label>
                                            <input type="text" class="form-control" id="submenuName"
                                                placeholder="Nome" required wire:model.lazy="submenu.name">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="submenuRoute">Rota</label>
                                            <input type="text" class="form-control" id="submenuRoute"
                                                placeholder="ex: submenu.index" required wire:model.lazy="submenu.route">
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary mt-4">Salvar Submenu</button>
                                    <button type="button" class="btn btn-secondary mt-4"
                                        data-bs-dismiss="modal">Cancelar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
