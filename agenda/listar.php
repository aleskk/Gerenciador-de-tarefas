<?php
require_once '../comum/header.php';
require_once '../ferramentas/validar_login.php';
require_once '../ferramentas/conexao.php';
include_once '../comum/tipos_acesso.php';

$acessos = $_SESSION['acessos'];


if ($acessos[TipoAcesso::VISUALIZAR_AGENDA]) {

  $id = $_GET['id_empresa'];
  $sql_list = $pdo->prepare('SELECT tarefa,id_empresa,id_agenda FROM agenda where id_empresa = :id_empresa');
  $sql_list->bindValue(':id_empresa', $id);
  $sql_list->execute();
  $result_list = $sql_list->fetchAll(PDO::FETCH_ASSOC);

  if (empty($result_list)) {
    echo 'Algo errado não está certo';
  } else {
    foreach ($result_list as $row) {
      $id = $row['id_empresa'];
      $id_agenda = $row['id_agenda'];
      $tarefa = $row['tarefa'];
      echo "<a href='agenda.php?id_empresa=" . $id . "&id_agenda=" . $id_agenda . "'>" . $tarefa . "</a><br>";
    }
  }
  echo "<a href='incluir.php?id_empresa=" . $id . "'>Incluir</a>'";
} else {
  echo "<script>
  Swal.fire({
    icon: 'error',
    title: 'Você não tem permissão de acessar essa área',
    showConfirmButton: false,
  
  })</script>";
}
