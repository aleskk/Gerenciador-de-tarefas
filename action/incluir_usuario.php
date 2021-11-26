<?php

require_once '../comum/header.php';
include '../ferramentas/conexao.php';
include '../ferramentas/validar_login.php';

$usuario = $_POST['nome'];
$senha1 = $_POST['senha'];
$senha2 = $_POST['senha2'];
$email = $_POST['email'];
$senha = password_hash($senha1, PASSWORD_DEFAULT);

if ($senha1 == $senha2) {

    $sql_users = $pdo->prepare("INSERT INTO usuarios (usuario,senha,email) values (:usuario,:senha,:email)");
    $sql_users->bindValue(':usuario', $usuario);
    $sql_users->bindValue(':senha', $senha);
    $sql_users->bindValue(':email', $email);
    $result = $sql_users->execute();

    echo "<script>Swal.fire({
                position: 'top',
                 icon: 'success',
                 title: 'Usuário cadastrado com sucesso',
                 showConfirmButton: true,
                 confirmButtonText: '<a class=\"link-light\" href=\"/usuarios/usuarios.php\">Ok</a>',
                 allowOutsideClick: false,
    })
                 </script>
                ";
} else {
    echo "<script>Swal.fire({
        icon: 'error',
        title: 'Erro',
        text: 'Digite uma senha válida!',
        confirmButtonText: '<a class=\"link-light\" href=\"/usuarios/usuarios.php\">Voltar</a>'
      })</script>";
}
