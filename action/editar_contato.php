<?php
include '../ferramentas/validar_login.php';
require_once '../comum/header.php';
include_once '../ferramentas/conexao.php';

$id_contatos = $_GET['id_contatos'];
$nome_contato = $_POST['nome'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$setor = $_POST['setor'];


if (empty($setor)) {
    echo 'Algo de errado não está certo';
} else {
    $sql_editar_contatos = $pdo->prepare('UPDATE contatos SET nome = :nome_contatos, telefone = :telefone, email =:email, setor = :setor
    WHERE id_contatos = :id_contatos');
    $sql_editar_contatos->bindValue(':nome_contatos', $nome_contato);
    $sql_editar_contatos->bindValue(':telefone', $telefone);
    $sql_editar_contatos->bindValue(':email', $email);
    $sql_editar_contatos->bindValue(':setor', $setor);
    $sql_editar_contatos->bindValue(':id_contatos', $id_contatos);
    $sql_editar_contatos->execute();
    echo "<script>Swal.fire({
        position: 'top',
         icon: 'success',
         title: 'Contato alterado com sucesso',
         showConfirmButton: true,
         confirmButtonText: '<a class=\"link-light\" href=\"/telas_iniciais/menu.php\">Ok</a>',
         allowOutsideClick: false,
         
    })
         </script>
        ";
}
