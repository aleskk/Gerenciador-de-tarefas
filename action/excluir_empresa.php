
<?php

include '../ferramentas/conexao.php';
include '../ferramentas/validar_login.php';
include_once '../comum/tipos_acesso.php';

$acessos = $_SESSION['acessos'];


if ($acessos[TipoAcesso::EXCLUIR_EMPRESA]) {
    $id_empresa = $_POST['id_empresa'];

    $sql = $pdo->prepare("UPDATE empresas set excluido = 'S' where id_empresa = :id");
    $sql->bindValue(':id', $id_empresa);
    $sql->execute();
   
        
}
