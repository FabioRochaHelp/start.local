<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Redefinição de Senha</title>
</head>
<body>
    <h2>Redefinição de Senha</h2>
    <p>Você solicitou a redefinição de senha. Clique no link abaixo para continuar:</p>
    <a href="{{ route('password.reset', ['token' => $token]) }}">Redefinir Senha</a>
    <p>Este link é válido por 5 minutos.</p>
</body>
</html>