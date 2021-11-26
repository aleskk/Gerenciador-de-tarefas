<?php
session_start();
include_once '../comum/header.php';
include_once '../ferramentas/conexao.php';
$provedor = $_POST['provedor'];
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
$porta = $_POST['porta'];

$sql = $pdo->prepare("INSERT INTO email (provedor,usuario,senha,porta) VALUES(:provedor,:usuario,:senha,:porta)");
$sql->bindValue(':provedor',$provedor);
$sql->bindValue(':usuario',$usuario);
$sql->bindValue(':senha',$senha);
$sql->bindValue(':porta',$porta);

$sql->execute();
echo "<script>
    Swal.fire({
        position: 'top',
        icon: 'success',
        title: 'Provedor de e-mail alterado com sucesso!',
        showConfirmButton: false,
      })</script>";
    header("Refresh:4; url=../telas_iniciais/menu.php");