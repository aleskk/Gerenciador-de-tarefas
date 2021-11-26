<?php
include '../ferramentas/validar_login.php';
require_once '../comum/header.php';
include_once '../ferramentas/conexao.php';

$id_agenda = $_GET['id_agenda'];
$tarefa = $_POST['tarefa'];
$dia_inicio = $_POST['dia_inicio'];
$dia_termino = $_POST['dia_termino'];



if (empty($id_agenda)) {
    echo 'Algo de errado não está certo';
} else {
    $sql_editar_agenda = $pdo->prepare('UPDATE agenda SET tarefa = :tarefa, dia_inicio = :dia_inicio, dia_termino =:dia_termino
    WHERE id_agenda= :id_agenda');
    $sql_editar_agenda->bindValue(':tarefa', $tarefa);
    $sql_editar_agenda->bindValue(':dia_inicio', $dia_inicio);
    $sql_editar_agenda->bindValue(':dia_termino', $dia_termino);
    $sql_editar_agenda->bindValue(':id_agenda', $id_agenda);
    $sql_editar_agenda->execute();
    $resultado = $sql_editar_agenda->execute();
    echo "<script>Swal.fire({
        position: 'top',
         icon: 'success',
         title: 'Tarefa alterada com sucesso',
         showConfirmButton: true,
         confirmButtonText: '<a class=\"link-light\" href=\"/telas_iniciais/menu.php\">Ok</a>',
         allowOutsideClick: false,
         
    })
         </script>
        ";
}
