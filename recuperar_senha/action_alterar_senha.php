<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Document</title>
</head>

<body>

    <?php
    require_once 'validar.php';
    include_once '../ferramentas/conexao.php';

    $user = $_POST['user'];
    $senha = $_POST['senha'];
    $senha2 = $_POST['senha2'];
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    $sql = $pdo->prepare("SELECT id,senha,usuario FROM usuarios where usuario = :user");
    $sql->bindValue(':user', $user);
    $sql->execute();


    if ($senha == $senha2) {
        
        
        $sql = $pdo->prepare("UPDATE usuarios SET senha = :senha WHERE usuario = :user");
        $sql->bindValue(':user', $user);
        $sql->bindValue(':senha',$senha_hash);
        $sql->execute();
        echo "<script>
    Swal.fire({
        position: 'top',
        icon: 'success',
        title: 'Senha alterada com sucesso!',
        showConfirmButton: false,
      })</script>";
      header("Refresh:7; url=../telas_iniciais/login.php");
    } else {
        echo "<script>Swal.fire({
        icon: 'error',
        title: 'Digite a mesma senha nos dois campos!',
      })</script>
      <a href=\"alterar_senha.php\" class=\"btn btn primary\">Voltar</a>
      ";
    }
