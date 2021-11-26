<?php

include '../ferramentas/conexao.php';
include '../ferramentas/validar_login.php';
include_once '../comum/tipos_acesso.php';

$acessos = $_SESSION['acessos'];


if ($acessos[TipoAcesso::EXCLUIR_USUARIOS]) {
 $id = $_POST['id'];

$sql = $pdo->prepare("UPDATE usuarios set excluido = 'S' where id = :id");
$sql->bindValue(':id', $id);
$sql->execute();
}