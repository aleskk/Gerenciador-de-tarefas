<?php

include_once '../comum/header.php';
include '../ferramentas/conexao.php';
include '../ferramentas/validar_login.php';
include_once '../comum/acessos.php';

$acessos = $_SESSION['acessos'];


if ($acessos[TipoAcesso::INCLUIR_CONTATOS]) {

    $id_empresa = $_GET['id_empresa'];
    $nome_contato = $_POST['nome'];
    $setor = $_POST['setor'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];



    $sql_contato = $pdo->prepare('INSERT INTO contatos (nome,telefone,email,setor,id_empresa) values(:nome_contato, :telefone, :email,:setor,:id_empresa)');

    $sql_contato->bindValue(':nome_contato', $nome_contato);
    $sql_contato->bindValue(':telefone', $telefone);
    $sql_contato->bindValue(':email', $email);
    $sql_contato->bindValue(':setor', $setor);
    $sql_contato->bindValue(':id_empresa', $id_empresa);
    $sql_contato->execute();
    echo "<script>Swal.fire({
      position: 'top',
       icon: 'success',
       title: 'Contato cadastrado com sucesso',
       showConfirmButton: true,
       confirmButtonText: '<a class=\"link-light\" href=\"/telas_iniciais/menu.php\">Ok</a>',
       allowOutsideClick: false,
       
  })
       </script>
      ";
}
