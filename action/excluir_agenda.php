<?php

include '../ferramentas/conexao.php';
include '../ferramentas/validar_login.php';
include_once '../comum/tipos_acesso.php';

$acessos = $_SESSION['acessos'];
$id_agenda = $_POST['id_agenda'];


if ($acessos[TipoAcesso::EXCLUIR_AGENDA]) {
    $sql = $pdo->prepare("UPDATE agenda set excluido = 'S' where id_agenda = :id_agenda");

    $sql->bindValue(':id_agenda', $id_agenda);

    $sql->execute();

    $resultado = $sql->execute();
}
