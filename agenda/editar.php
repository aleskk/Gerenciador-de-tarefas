<?php
include '../ferramentas/validar_login.php';
include '../ferramentas/conexao.php';
require_once '../comum/header.php';
include_once '../comum/tipos_acesso.php';

$acessos = $_SESSION['acessos'];
$id_agenda = $_GET['id_agenda'];

if ($acessos[TipoAcesso::EDITAR_AGENDA]) {

  $sql = $pdo->prepare("SELECT id_agenda,tarefa,dia_inicio,dia_termino FROM agenda where id_agenda = :id_agenda");
  $sql->bindValue(':id_agenda', $id_agenda);
  $sql->execute();
  $result_agenda = $sql->fetchAll(PDO::FETCH_ASSOC);
  foreach ($result_agenda as $row) {
    $id_agenda = $row['id_agenda'];
    $tarefa = $row['tarefa'];
    $dia_inicio = $row['dia_inicio'];
    $dia_termino = $row['dia_termino'];
  }
  echo "

    
    
  <div class=\"container\" >
  <div class=\"row g-3\">
      <div class=\"col\">
  <form method='POST' action='/action/editar_agenda.php?id_agenda=" . $id_agenda . "'>
    
  <h1 >Editar agenda</h1>
    
    <div class=\"mb-3\" >
      <label for=\"tarefa\" class=\"form-label\" >Tarefa</label>
      <input class=\"form-control\" id=\"tarefa\" input type='text' name='tarefa' placeholder='Tarefa' value=" . $tarefa . ">
    </div>
    <div class=\"mb-3\">
      <label for=\"dia_inicio\" class=\"form-label\">Dia de inicio</label>
      <input class=\"form-control\" id=\"dia_inicio\" type='text' name='dia_inicio' placeholder='Dia início'value=" . $dia_inicio . ">
    </div>
    <div class=\"mb-3\">
      <label for=\"dia_termino\" class=\"form-label\">Dia de término</label>
      <input class=\"form-control\" id=\"dia_termino\"  type='text' name='dia_termino' placeholder='Dia término' value=" . $dia_termino . ">
    </div>  
    </div>
    </div>
    <br>
    <div class=\"row\">
      <div class=\"col\">
        <button type='submit' class=\"btn btn-outline-primary\">Salvar <i class=\"fas fa-check\"></i></button>
      </div>   
      </div>
      </form>
  </div>
</div>
    ";
} else {
  echo "<script>
  Swal.fire({
    icon: 'error',
    title: 'Você não tem permissão de acessar essa área',
    showConfirmButton: false,
  
  })</script>";
}

?>
</body>

</html>