<?php

require_once '../comum/header.php';
include '../ferramentas/conexao.php';
include '../ferramentas/validar_login.php';

$id_empresa = $_GET['id_empresa'];
$tarefa = $_POST['tarefa'];
$dia_inicio = $_POST['dia_inicio'];
$dia_termino = $_POST['dia_termino'];



    $sql_agenda = $pdo->prepare('INSERT INTO agenda (tarefa,dia_inicio,dia_termino,id_empresa) values(:tarefa, :dia_inicio, :dia_termino,:id_empresa)');

    $sql_agenda->bindValue(':tarefa', $tarefa);
    $sql_agenda->bindValue(':dia_inicio', $dia_inicio);
    $sql_agenda->bindValue(':dia_termino', $dia_termino);
    $sql_agenda->bindValue(':id_empresa', $id_empresa);
    $sql_agenda->execute();

    echo "<script>Swal.fire({
      position: 'top',
       icon: 'success',
       title: 'Tarefa cadastrada com sucesso',
       showConfirmButton: true,
       confirmButtonText: '<a class=\"link-light\" href=\"/telas_iniciais/menu.php\">Ok</a>',
       allowOutsideClick: false,
       
  })
       </script>
      ";
