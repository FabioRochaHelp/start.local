<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Login - STARTKIT</title>
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
                    <div class="ms-auth-form">
                        <form class="needs-validation" method="POST" action="{{ route('password.new') }}">
                            <input type="hidden" name="email" value="{{ $user->email }}">
                            @csrf
                            @if ($errors->has('erros'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('erros') }}
                                </div>
                            @endif
                            @if ($errors->has('success'))
                                <div class="alert alert-success">
                                    {{ $errors->first('success') }}
                                </div>
                            @endif
                            <h1>{{ $user->name }}</h1>
                            <p>Por favor informe a nova senha</p>
                            <p class="text-success bold">A senha deve conter pelo menos uma letra maiúscula, um número e
                                um caractere especial.</p>
                            <div class="mb-3">
                                <label for="validationCustom08">Senha</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="password" id="validationCustom08"
                                        placeholder="Senha" required="">
                                </div>
                                @error('password')
                                    <p>
                                        <span class="text-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    </p>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="validationCustom09">Confirme a nova senha</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="password_confirmation"
                                        id="validationCustom09" placeholder="Confirme a nova senha" required="">
                                </div>
                                @error('password_confirmation')
                                    <p>
                                        <span class="text-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    </p>
                                @enderror
                            </div>
                            <button class="btn btn-primary mt-4 d-block w-100" type="submit">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- SCRIPTS -->
    <!-- Global Required Scripts Start -->
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
