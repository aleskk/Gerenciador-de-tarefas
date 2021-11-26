<?php

require_once 'validar.php';
$user = $_GET['user']

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/f20c6e805e.js" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Document</title>
</head>

<body>
<div class="container">
        <div class="row g-3">
            <div class="col">
                <form method="POST" action="/recuperar_senha/action_alterar_senha.php">

                    
                        <h1>Redefinir a senha</h1>
                        <br>
                        <div class="mb-3">
                            <label for="user" class="form-label">Usuário</label>
                            <input class="form-control" type="text" name="user" id="user" placeholder="Usuário">
                        </div>
                        <br>
                        <div class="mb-3">
                            <label for="senha" class="form-label">Digite a sua senha:</label>
                            <input class="form-control" type="password" name="senha" id="senha" placeholder="Digite a  sua senha">
                        </div>
                        <br>
                        <div class="mb-3">
                            <label for="senha2" class="form-label">Digite novamente sua senha:</label>
                            <input class="form-control" type="password" name="senha2" id="senha2" placeholder="repita a sua senha">
                        </div>
                        <br>
                        <div class="mb-3">
                        <button type="submit" class="btn btn-outline-primary">Enviar <i class="fas fa-check"></i></button>
                        </div>
                    
                </form>
            </div>
        </div>
    </div>
</body>

</html>