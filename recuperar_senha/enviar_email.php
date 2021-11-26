<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/f20c6e805e.js" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Sistema de Gerenciamento de Clientes</title>
</head>

<body>
    <div class="container">
        <div class="row g-3">
            <div class="col">
                <form method="POST" action="/recuperar_senha/action_enviar_email.php">

                    <h1>Recuperação de senha</h1>
                    <div class="mb-3">
                        <label for="user">Usuário</label>
                        <input class="form-control"type="text" name="user" id="user" placeholder="Usuário">
                    </div>
                    <br>
                    <div class="mb-3">
                        <label for="email">E-mail</label>
                        <input class="form-control"type="email" name="email" id="email" placeholder="E-mail">
                    </div>
                    <br>
                    <div class="mb-3">
                        <a href="/telas_iniciais/login.php" class="btn btn-outline-primary">Voltar <i class="fas fa-undo-alt"></i></a>
                        <button type="submit" class="btn btn-outline-primary">Enviar <i class="fas fa-check"></i></button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>

</html>