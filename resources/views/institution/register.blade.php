<x-layout title='Adicionar Instituição'>
    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb ps-0">
                        <li class="breadcrumb-item"><i class="material-icons">home</i> <a
                            href="{{ route('home.view') }}">Home</a> </li>
                        <li class="breadcrumb-item"> Gerenciamento </li>
                        <li class="breadcrumb-item"> Instituição </li>
                        <li class="breadcrumb-item active" aria-current="page">Adicionar</li>
                    </ol>
                </nav>
            </div>
            <div class="col-xl-12 col-md-12">
                <div class="ms-panel">
                    <div class="ms-panel-header ms-panel-custome">
                        <h6>Adicionar Instituição</h6>
                        <a href="{{ route('institution.list.view') }}" class="ms-text-primary">Lista de Instituições</a>
                    </div>
                    <div class="ms-panel-body">
                        <div id="preloader" style="display: none" class="spinner spinner-3">
                            <div class="rect1"></div>
                            <div class="rect2"></div>
                            <div class="rect3"></div>
                            <div class="rect4"></div>
                            <div class="rect5"></div>
                        </div>
                        <form class="needs-validation" method="POST" action="{{ route('institution.register.form') }}"
                            enctype="multipart/form-data" id="institution-form">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom0002">CNPJ</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control cpf_cnpj"
                                            placeholder="Insira o CNPJ da instituição" name="cnpj" id="cnpj_cpf"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom0001">Nome da Instituição</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="validationCustom0001"
                                            placeholder="Insira o nome da instituição" name="name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-2">
                                    <label for="validationCustom007">CEP</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control cep" id="cep"
                                            placeholder="Insira o CEP" name="postalcode" required>
                                    </div>
                                </div>
                                <div class="col-md-8 mb-2">
                                    <label for="validationCustom003">Rua</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="logradouro"
                                            placeholder="Insira a Rua" name="street_name" required>
                                    </div>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="validationCustom004">Número</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="validationCustom004"
                                            placeholder="Insira o número" name='number' required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom006">Bairro</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="bairro"
                                            placeholder="Insira o Bairro" name="neighborhood" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom005">Complemento</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="validationCustom005"
                                            placeholder="Insira o Complemento" name="complement">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8 mb-2">
                                    <label for="validationCustom008">Cidade</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="cidade"
                                            placeholder="Insira a Cidade" name="city" required>
                                    </div>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label for="validationCustom009">Estado</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="uf"
                                            placeholder="Insira o Estado" name="state" required>
                                    </div>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label for="validationCustom010">Pais</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="validationCustom010"
                                            placeholder="Insira o Pais" name="country" value="BR" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom001">E-mail</label>
                                    <div class="input-group">
                                        <input type="email" class="form-control" id="validationCustom001"
                                            placeholder="Insira o e-mail da instituição" name="email" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom002">Telefone</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control telefone" id="validationCustom002"
                                            placeholder="Insira o telefone da instituição" name="phone" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom003">Responsável</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="validationCustom003"
                                            placeholder="Insira o nome do responsável" name="responsability" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom004">CPF</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control cpf_cnpj"
                                            placeholder="Insira o CPF do responsável" name="cpf" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label>Logo</label>
                                    <div class="input-group">
                                        <input type="file" name="image" class="form-control"
                                            id="validatedCustomFile">
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-warning mt-4 d-inline w-20" type="reset">Limpar</button>
                            <button class="btn btn-primary mt-4 d-inline w-20" id="btn-save"
                                type="submit">Adicionar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>

<script src="https://code.jquery.com/jquery-3.6.1.min.js"
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script src="{{ asset('/assets/js/toastr.min.js') }}"></script>
<script src="{{ asset('/assets/js/toast.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#institution-form').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('institution.register.form') }}",
                data: formData,
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $("#response").html('');
                    $("#btn-save").text('Por favor, aguarde...');
                    $("#btn-save").attr('disabled', true);
                },
                success: function(response) {
                    $("#btn-save").text('Adicionar');
                    $("#btn-save").removeAttr('disabled');
                    if (!response.error) {
                        if (response.info) {
                            $('#response').html('<div class="alert alert-info">' + response
                                .info + '</div>');
                        } else {
                            toastr.options.positionClass = "toast-top-right";
                            toastr.success('Operacão foi concluída com sucesso.',
                                'Sucesso!');
                            $('#institution-form')[0].reset(); // Limpa o formulário
                            setTimeout(function() {
                                window.location.href =
                                    "{{ route('institution.register.form') }}";
                            }, 2000); // 2 segundos de delay para o redirecionamento
                        }
                    } else {
                        $('#response').html('<div class="alert alert-danger">' + response
                            .error + '</div>');
                        if (response.errors_model) {
                            $.each(response.errors_model, function(key, value) {
                                $('#response').append(
                                    '<ul class="list-unstyled"><li class="text-danger">' +
                                    value + '</li></ul>');
                            });
                        }
                    }
                },
                error: function() {
                    alert(
                        'Não foi possível processar a solicitação. Por favor entre em contato com o suporte técnico.'
                    );
                    $("#btn-save").text('Adicionar');
                    $("#btn-save").removeAttr('disabled');
                }
            });
        });
        $("form").submit(function() {
            $(this).find(":submit").attr('disabled', 'disabled');
        });
    });
    $(".cpf_cnpj").mask("000.000.000-00", {
        onKeyPress: function(cpfcnpj, e, field, options) {
            var masks = ['000.000.000-000', '00.000.000/0000-00'];
            var mask = (cpfcnpj.length > 14) ? masks[1] : masks[0];
            $('.cpf_cnpj').mask(mask, options);
        }
    });
    $(".telefone").mask("(00) 0000-00009", {
        onKeyPress: function(telefone, e, field, options) {
            var masks = ['(00) 00000-0000', '(00) 0000-00009'];
            var mask = (telefone.replace(/\D/g, '').length > 10) ? masks[0] : masks[1];
            $('.telefone').mask(mask, options);
        }
    });
    $(".cep").mask("00000-000");
    //OUVINTE PARA REQUISIÇÃO DE ENDEREÇO
    const cepInput = document.getElementById('cep');
    if (cepInput != null) {

        cepInput.addEventListener('change', function() {

            let cep = cepInput.value.replace(/\D/g, '');

            if (cep.length === 8) {
                fetch(`https://viacep.com.br/ws/${cep}/json/`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('logradouro').value = data.logradouro || '';
                        document.getElementById('bairro').value = data.bairro || '';
                        document.getElementById('cidade').value = data.localidade || '';
                        document.getElementById('uf').value = data.uf || '';

                        // Esconde o preloader após obter a resposta
                    })
                    .catch(error =>
                        console.error('Erro ao consultar o CEP:', error));
                // Esconde o preloader em caso de erro
            }
        });
    }

    $(document).ready(function() {

        $('#cnpj_cpf').on('change', function(e) {
            const inputCnpj = document.getElementById('cnpj_cpf');
            let cnpj = inputCnpj.value.replace(/\D/g, '');


            $.ajax({
                type: 'GET',
                url: '{{ route('institution.show', ['id' => ':id']) }}'.replace(':id', cnpj),
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
