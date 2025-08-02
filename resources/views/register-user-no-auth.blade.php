
    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb ps-0">
                        <li class="breadcrumb-item"><i class="material-icons">home</i> <a
                            href="{{ route('home.view') }}">Home</a> </li>
                        <li class="breadcrumb-item"> Gerenciamento </li>
                        <li class="breadcrumb-item"> Usuário </li>
                        <li class="breadcrumb-item active" aria-current="page">Adicionar</li>
                    </ol>
                </nav>
            </div>
            <div class="col-xl-12 col-md-12">
                <div class="ms-panel">
                    <div class="ms-panel-header ms-panel-custome">
                        <h6>Adicionar Usuário</h6>
                        <a href="{{ route('user.list.view') }}" class="ms-text-primary">Lista de Usuários</a>
                    </div>
                    <div class="ms-panel-body">
                        <form class="needs-validation" method="POST" action="{{ route('user.register.form') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="validationCustom001">Nome</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="validationCustom001" placeholder="Insira o nome do usuário" name="name" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom002">CPF</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="validationCustom002" placeholder="Insira o CPF do usuário" name="cpf" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label id="validationCustom003">Idade</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="validationCustom003" placeholder="Insira a idade do usuário" name="age" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Sexo</label>
                                    <ul class="ms-list d-flex">
                                        <li class="ms-list-item">
                                            <label class="ms-checkbox-wrap">
                                            <input type="radio" name="gender" value="F" checked="">
                                            <i class="ms-checkbox-check"></i>
                                            </label>
                                            <span> Feminino </span>
                                        </li>
                                        <li class="ms-list-item ps-0">
                                            <label class="ms-checkbox-wrap">
                                            <input type="radio" name="gender" value="M">
                                            <i class="ms-checkbox-check"></i>
                                            </label>
                                            <span> Masculino </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom006">Cargo</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="validationCustom006" placeholder="Insira o cargo do usuário" name="jobrole" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="validationCustom007">Departamento</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="validationCustom007" placeholder="Insira o departamento do usuário" name="department" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom004">Email</label>
                                    <div class="input-group">
                                        <input type="email" class="form-control" id="validationCustom004" placeholder="Insira o email do usuário" name="email" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom010">Telefone</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="validationCustom010" placeholder="Insira o telefone do usuário" name="phone" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="validationCustom005">Senha</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="validationCustom005" placeholder="Insira a senha do usuário" name="password" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="validationCustom009">Confirme a Senha</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="validationCustom009" placeholder="Confirme a senha do usuário" name="co-password" required>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-warning mt-4 d-inline w-20" type="reset">Limpar</button>
                            <button class="btn btn-primary mt-4 d-inline w-20" type="submit">Adicionar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>