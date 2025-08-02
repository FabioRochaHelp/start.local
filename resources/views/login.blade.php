<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Login - CCIH 4 Web</title>
    <!-- Iconic Fonts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('/vendors/iconic-fonts/font-awesome/css/all.min.css') }} " rel="stylesheet">
    <link rel="stylesheet" href="{{ '/vendors/iconic-fonts/flat-icons/flaticon.css' }}">
    <link rel="stylesheet" href="{{ '/vendors/iconic-fonts/cryptocoins/cryptocoins.css' }}">
    <link rel="stylesheet" href="{{ '/vendors/iconic-fonts/cryptocoins/cryptocoins-colors.css' }}">
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }} " rel="stylesheet">
    <!-- jQuery UI -->
    <link href="{{ asset('assets/css/jquery-ui.min.css') }} " rel="stylesheet">
    <!-- Docfindboard styles -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="../../favicon.ico">
</head>

<body class="ms-body ms-primary-theme ms-logged-out">
    <!-- Main Content -->
    <main class="body-content">
        <!-- Body Content Wrapper -->
        <div class="ms-content-wrapper ms-auth">
            <div class="ms-auth-container">
                <div class="ms-auth-col">
                    <div class="ms-auth-bg"></div>
                </div>
                <div class="ms-auth-col">
                    <div class="ms-auth-form">
                        <form class="needs-validation" method="POST" action="{{ route('login.form') }}">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    {{ $errors->first('erros') }}
                                </div>
                            @endif
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <div class="text-center mb-5">
                                <img src="{{ asset('landpage/img/logo-ligth-verde.png') }}" width="200" alt="">
                            </div>
                         
                            <h1>Login</h1>
                            <p>Por favor entre com seu email e senha cadastrados</p>
                            <div class="mb-3">
                                <label for="validationCustom08">Email</label>
                                <div class="input-group">
                                    <input type="email" class="form-control" name="email" id="validationCustom08"
                                        placeholder="Email" required="">
                                    <div class="invalid-feedback">
                                        Por favor insira um email valido.
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label for="validationCustom09">Senha</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="password" id="validationCustom09"
                                        placeholder="Senha" required="">
                                    <div class="invalid-feedback">
                                        Por favor insira uma senha.
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                {{-- <label class="ms-checkbox-wrap">
                                    <input class="form-check-input" type="checkbox" value="">
                                    <i class="ms-checkbox-check"></i>
                                </label>
                                <span> Lembrar Senha </span> --}}
                                <label class="d-block mt-3"><a href="#" class="btn-link" data-bs-toggle="modal"
                                    data-bs-target="#modal-13">Primeiro acesso?</a></label>
                                <label class="d-block mt-3"><a href="#" class="btn-link" data-bs-toggle="modal"
                                        data-bs-target="#modal-12">Esqueceu a senha?</a></label>
                            </div>
                            <button class="btn btn-primary mt-4 d-block w-100" type="submit">Entrar</button>
                            <div class="cf-turnstile text-center mt-5" data-sitekey="0x4AAAAAAAdspZ-EFy7QgYad" data-callback="javascriptCallback"></div>
                        </form>
                        
                    </div>
                    
                </div>
                 
            </div>
        </div>
        <!-- Forgot Password Modal -->
        <div class="modal fade" id="modal-12" tabindex="-1" role="dialog" aria-labelledby="modal-12">
            <div class="modal-dialog modal-dialog-centered modal-min" role="document">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <i class="flaticon-secure-shield d-block"></i>
                        <h1>Esqueceu a senha?</h1>
                        <p> Insira seu email para a recuperação de senha </p>
                        <form class="needs-validation" method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="ms-form-group has-icon">
                                <input type="text" placeholder="Email" class="form-control" name="email"
                                    value="">
                                <i class="material-icons">email</i>
                            </div>
                            <button type="submit" class="btn btn-primary shadow-none">Resetar Senha</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Forgot Password Modal -->
        
        <!-- First Access Modal -->
        <div class="modal fade" id="modal-13" tabindex="-1" role="dialog" aria-labelledby="modal-12">
            <div class="modal-dialog modal-dialog-centered modal-min" role="document">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <i class="flaticon-user "></i>
                        <h1>Seja bem vindo(a)!</h1>
                        <p> Insira seu email cadastrado no sistema. </p>
                        <form class="needs-validation" method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="ms-form-group has-icon">
                                <input type="text" placeholder="Email" class="form-control" name="email"
                                    value="">
                                <i class="material-icons">email</i>
                            </div>
                            <button type="submit" class="btn btn-primary shadow-none">Solicitar acesso</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <!-- SCRIPTS -->
    <!-- Global Required Scripts Start -->
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
    <script src="{{ asset('assets/js/jquery-3.3.1.min.js') }} "></script>
    <script src="{{ asset('assets/js/popper.min.js') }} "></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }} "></script>
    <script src="{{ asset('assets/js/perfect-scrollbar.js') }} "></script>
    <script src="{{ asset('assets/js/jquery-ui.min.js') }} "></script>
    <!-- Global Required Scripts End -->
    <!-- Docfindboard core JavaScript -->
    <script src="{{ asset('assets/js/framework.js') }} "></script>
    <!-- Settings -->
    <script src="{{ asset('assets/js/settings.js') }} "></script>
</body>

</html>
