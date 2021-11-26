<?php
// Projeto começou dia 26 de Outubro as 14:13 ❤


session_start();
if (isset($_SESSION['login'])) {
    header('location: ../telas_iniciais/menu.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Login</title>
</head>

<body>

    <!-- Atribuindo um método para receber os dados digitados e enviando pelo botão-->
    <div class="container">
        <div class="position-relative">
            <div class=" d-flex justify-content-center">
                <div class="row">
                    <div class="col-sm-7">
                        <form method="POST" action="telas_iniciais/login.php">
                            <h1 class="login">Login</h1>
                            <div class="mb-3">
                                <label for="name" class="form-label">Usuário</label>
                                <input type="text" name="nome" id="name" placeholder="Usuário" required class="form-control" autofocus>
                            </div>
                            <div class="mb-3">
                                <label for="senha" class="form-label">Senha</label>
                                <input type="password" name="senha" id="senha" placeholder="Senha" required class="form-control">
                            </div>
                            <input type="submit" value="Login" class="btn btn-primary">
                    </div>
                    <a href="/recuperar_senha/enviar_email.php" class="">Esqueceu a sua senha?</a>
                </div>
            </div>
        </div>

    </div>

    </form>
    </div>
</body>

</html>