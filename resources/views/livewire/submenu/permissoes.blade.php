<div>
    <div class="ms-panel">
        <div class="ms-panel-header ms-panel-custome">
            <h6>Lista de Submenus - {{ $menu->name ?? '—' }}</h6>
            <!-- Botão para abrir o modal -->

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#report1">
                Adicionar Submenu
            </button>
        </div>
        <div class="ms-panel-body">
            <div class="table">
                <table class="table thead-primary ">
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
                                                <a class="media p-2" wire:click="edit({{ $subMenu->id }})">
                                                    <div class="media-body">
                                                        <span>Editar</span>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                                <td>{{ $subMenu->url }}</td>

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
    <div class="modal fade" id="report1" tabindex="-1" style="display: none;" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog ms-modal-dialog-width">
            <div class="modal-content ms-modal-content-width">
                <div class="modal-header ms-modal-header-radius-0">
                    <h4 class="modal-title text-white">{{ $editing ? 'Editar Submenu' : 'Adicionar Submenu' }}</h4>
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
                                <form wire:submit.prevent="createSubmenu">
                                    <input type="hidden" wire:model="subMenuId">
                                    <input type="hidden" wire:model="menuId">

                                    <div class="row">
                                        {{-- Campo Nome --}}
                                        <div class="col-md-4 mb-3">
                                            <label for="submenuIcon">Ícone</label>
                                            <input type="text" id="submenuIcon" class="form-control"
                                                placeholder="Ícone" wire:model="icon">
                                        </div>
                                        {{-- Campo Nome --}}
                                        <div class="col-md-4 mb-3">
                                            <label for="submenuName">Nome do Submenu</label>
                                            <input type="text" id="submenuName"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="Nome" wire:model="subMenuName">
                                            @error('name')
                                                <span class="">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- Campo URL --}}
                                        <div class="col-md-4 mb-3">
                                            <label for="submenuRoute">Rota</label>
                                            <input type="text" id="submenuRoute"
                                                class="form-control @error('url') is-invalid @enderror"
                                                placeholder="ex: submenu.index" wire:model="url">
                                            @error('url')
                                                <span class="">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        {{-- Campo Direct --}}
                                        <div class="form-check">
                                            <label class="ms-switch">
                                                <input type="checkbox" wire:model="direct">
                                                <span class="ms-switch-slider ms-switch-danger round"></span>
                                            </label>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary mt-4">Salvar</button>
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
<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('closeModal', (data) => {
            const modalEl = document.getElementById(data.id);
            const modalInstance = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
            modalInstance.hide();
        });
    });
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('openModal', (data) => {
            const modalEl = document.getElementById(data.id);
            const modalInstance = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
            modalInstance.show();
        });
    })
</script>
