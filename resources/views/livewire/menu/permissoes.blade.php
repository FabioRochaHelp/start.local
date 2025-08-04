<div>
    <div class="ms-panel-body">
        <div class="table-responsive">
            <table class="table table-striped thead-primary">
                <th>Ícone</th>
                <th>Menu</th>
                <th>Rota</th>
                @foreach ($types as $type)
                    <th>{{ $type->name }}</th>
                @endforeach
                @if ($menus->count() == 0)
                    Nenhum menu cadastrado
                @else
                    @foreach ($menus as $menu)
                        <tr>
                            <td> <i class="{{ $menu->icon }}"></i> </td>
                            <td>{{ $menu->name }} 

                                <div class="dropdown float-end">
                                    <a href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li class="ms-dropdown-list">
                                            <a class="media p-2" href="{{route('submenu.list', ['menu' => $menu->id])}}">
                                                <div class="media-body">
                                                    <span>Submenu</span>
                                                </div>
                                            </a>
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
                            <td>{{ $menu->route }}</td>

                            @foreach ($types as $type)
                                <td>
                                    <div class="form-check">
                                        <label class="ms-switch">
                                            <input type="checkbox" checked="">
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
