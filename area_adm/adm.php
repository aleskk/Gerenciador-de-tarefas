<?php 
session_start();
include_once '../comum/header.php' ;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container">
        <div class="position-relative">
            <div class=" d-flex justify-content-center">
                <div class="row">
                    <div class="col">
                        <form method="POST" action="action.php">
                            <h1 class="login">Configurações</h1>
                            <div class="mb-3">
                                <label for="provedor" class="form-label">Provedor de E-mail utilizado</label>
                                <input type="text" name="provedor" id="provedor" placeholder="Provedor" required class="form-control" autofocus>
                                
                            <div class="mb-3">
                                <label for="porta" class="form-label">Porta utilizada</label>
                                <input type="number" name="porta" id="porta" placeholder="Porta" required class="form-control">
                            </div>
                            </div>
                            <div class="mb-3">
                                <label for="user" class="form-label">Usuário do E-mail</label>
                                <input type="text" name="usuario" id="user" placeholder="Usuário" required class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="senha" class="form-label">Senha</label>
                                <input type="password" name="senha" id="senha" placeholder="Senha" required class="form-control">
                            </div>
                            <button type="submit" class="btn btn-outline-primary">Alterar <i class="fas fa-check"></i></button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    </form>
    </div>
</body>
</html>