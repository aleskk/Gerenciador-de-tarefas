<?php

include '../ferramentas/conexao.php';
include '../ferramentas/validar_login.php';
include_once '../comum/tipos_acesso.php';

$acessos = $_SESSION['acessos'];
$id_contatos = $_POST['id_contato'];


if ($acessos[TipoAcesso::EXCLUIR_CONTATOS]) {
    $sql_contato = $pdo->prepare("UPDATE contatos set excluido = 'S' where id_contatos = :id_contatos");

    $sql_contato->bindValue(':id_contatos', $id_contatos);

    $sql_contato->execute();
    
}
