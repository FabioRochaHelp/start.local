<head>
    <style>
        /* Estilos para o modal */
        .modalUser {
            display: none;
            position: fixed;
            z-index: 999;
            left: 0;
            top: 0;
            width: 100vw;
            height: 100vh;

            justify-content: center;
            align-items: center;

            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fefefe;
            padding: 20px;
            border: 1px solid #888;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
            -webkit-animation-name: animatetop;
            -webkit-animation-duration: 0.4s;
            animation-name: animatetop;
            animation-duration: 0.4s
        }

        @-webkit-keyframes animatetop {
            from {top:-300px; opacity:0} 
            to {top:0; opacity:1}
        }

        @keyframes animatetop {
            from {top:-300px; opacity:0}
            to {top:0; opacity:1}
        }

        /* Estilos para a imagem recortada */
        #imagemRecortada {
            max-width: 100%;
            max-height: 400px;
            display: block;
            margin: 0 auto;
            border-radius: 100%;
        }
    </style>
</head>

<x-layout title='Editar Usuário'>
    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb ps-0">
                        <li class="breadcrumb-item"><i class="material-icons">home</i> <a
                            href="{{ route('home.view') }}">Home</a> </li>
                        <li class="breadcrumb-item"> Gerenciamento </li>
                        <li class="breadcrumb-item"> Usuário </li>
                        <li class="breadcrumb-item active" aria-current="page">Editar</li>
                    </ol>
                </nav>
            </div>
            <div class="col-xl-12 col-md-12">
                <div class="ms-panel">
                    <div class="ms-panel-header ms-panel-custome">
                        <h6>Editar Usuário de Id: {{ $user->id }}</h6>
                        <a href="{{ route('user.list.view') }}" class="ms-text-primary">Lista de Usuários</a>
                    </div>
                    <div class="ms-panel-body">
                        <form class="needs-validation" method="POST" action="{{ route('user.edit.form', ['id'=>$user->id]) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <label for="validationCustom6">Tipo de Usuário</label>
                                    <div class="input-group">
                                        <select name="role" class="form-control" id="validationCustom6" required>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom002">CPF</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="validationCustom002" placeholder="Insira o CPF do usuário" name="cpf" value="{{ $user->cpf }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="validationCustom001">Nome</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="validationCustom001" placeholder="Insira o nome do usuário" name="name" value="{{ $user->name}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label id="validationCustom003">Idade</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="validationCustom003" placeholder="Insira a idade do usuário" name="age" value="{{ $user->age }}" required>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    @if ($user->gender == 'F')
                                        <label>Sexo</label>
                                        <ul class="ms-list d-flex">
                                            <li class="ms-list-item">
                                                <label class="ms-checkbox-wrap">
                                                <input type="radio" name="gender" value="F" checked>
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
                                    @else
                                        <label>Sexo</label>
                                        <ul class="ms-list d-flex">
                                            <li class="ms-list-item">
                                                <label class="ms-checkbox-wrap">
                                                <input type="radio" name="gender" value="F" >
                                                <i class="ms-checkbox-check"></i>
                                                </label>
                                                <span> Feminino </span>
                                            </li>
                                            <li class="ms-list-item ps-0">
                                                <label class="ms-checkbox-wrap">
                                                <input type="radio" name="gender" value="M" checked>
                                                <i class="ms-checkbox-check"></i>
                                                </label>
                                                <span> Masculino </span>
                                            </li>
                                        </ul>
                                    @endif
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom010">Telefone</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="validationCustom010" placeholder="Insira o telefone do usuário" name="phone" value="{{ $user->phone }}" required>
                                    </div>
                                </div>
                            </div>
                            @if ($user->collaborator == null)
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom006">Cargo</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="validationCustom006" placeholder="Insira o cargo do usuário ou deixe vazio para usuarios sem cargo" name="jobrole" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="validationCustom007">Departamento</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="validationCustom007" placeholder="Insira o departamento do usuário ou deixe vazio para usuarios sem departamento" name="department" value="">
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom006">Cargo</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="validationCustom006" placeholder="Insira o cargo do usuário ou deixe vazio para usuarios sem cargo" name="jobrole" value="{{ $user->collaborator->job_role }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="validationCustom007">Departamento</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="validationCustom007" placeholder="Insira o departamento do usuário ou deixe vazio para usuarios sem departamento" name="department" value="{{ $user->collaborator->department }}">
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom004">Email</label>
                                    <div class="input-group">
                                        <input type="email" class="form-control" id="validationCustom004" placeholder="Insira o email do usuário" name="email" value="{{ $user->email }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Foto de Perfil</label>
                                    <div class="input-group">
                                        <input type="file" name="image" class="form-control" id="validatedCustomFileUser" accept="image/*" onchange="carregarImagem(this)">
                                    </div>
                                </div>
                            </div>

                            <div id="meuModal" class="modalUser modal-dialog-centered" style="display: none;">
                                <div class="modal-content" style="width: 600px;">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Como vai ficar sua foto</h4>
                                    </div>
                                    <div class="modal-body">
                                        <img id="imagemRecortada" src="#" alt="Imagem Recortada">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" onclick="fecharModal()">Ok</button>
                                    </div>
                                </div>
                            </div>

                            <a href="{{ route('user.list.view') }}" class="btn btn-warning">Cancelar</a>
                            <button class="btn btn-primary" type="submit">Editar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
<script>
    // Função para converter data URI em Blob
    function dataURItoBlob(dataURI) {
        var byteString = atob(dataURI.split(',')[1]);
        var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];
        var ab = new ArrayBuffer(byteString.length);
        var ia = new Uint8Array(ab);
        for (var i = 0; i < byteString.length; i++) {
            ia[i] = byteString.charCodeAt(i);
        }
        return new Blob([ab], { type: mimeString });
    }

    // Função para carregar a imagem selecionada
    function carregarImagem(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                var img = new Image();
                img.src = e.target.result;

                img.onload = function() {
                    // Calcula a largura e a altura do corte
                    var tamanho = Math.min(img.width, img.height);
                    var x = (img.width - tamanho) / 2;
                    var y = (img.height - tamanho) / 2;

                    // Cria um canvas para recortar a imagem
                    var canvas = document.createElement('canvas');
                    canvas.width = tamanho;
                    canvas.height = tamanho;

                    // Recorta a imagem
                    var ctx = canvas.getContext('2d');
                    ctx.drawImage(img, x, y, tamanho, tamanho, 0, 0, tamanho, tamanho);

                    // Exibe a imagem recortada no modal
                    var imagemRecortada = document.getElementById('imagemRecortada');
                    imagemRecortada.src = canvas.toDataURL();
                    abrirModal();
                };
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    // Função para abrir o modal
    function abrirModal() {
        var modal = document.getElementById('meuModal');
        modal.style.display = 'flex';
    }

    // Função para fechar o modal
    function fecharModal() {
        var modal = document.getElementById('meuModal');
        modal.style.display = 'none';
    }
</script>