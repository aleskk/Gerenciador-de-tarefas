<?php
include '../ferramentas/validar_login.php';
require_once '../comum/header.php';
include_once '../comum/tipos_acesso.php';

$acessos = $_SESSION['acessos'];


if ($acessos[TipoAcesso::INCLUIR_AGENDA]) {

  $id_empresa = $_GET['id_empresa'];
  echo "

    
    
  <div class=\"container\" >
  <div class=\"row g-3\">
    <div class=\"col\">
<form method='POST' action='/action/incluir_agenda.php?id_empresa=" . $id_empresa . "'>
<label class=\"h1\">Cadastrar agenda</label>
<div class=\"mb-3\" >
  <label for=\"tarefa\" class=\"form-label\" >Tarefa</label>
  <input class=\"form-control\" id=\"tarefa\" input type='text' name='tarefa' placeholder='Tarefa'>
</div>
<div class=\"mb-3\">
  <label for=\"dia_inicio\" class=\"form-label\">Dia de inicio</label>
  <input class=\"form-control\" id=\"dia_inicio\" type='text' name='dia_inicio' placeholder='Dia início'>
</div>
<div class=\"mb-3\">
  <label for=\"dia_termino\" class=\"form-label\">Dia de término</label>
  <input class=\"form-control\" id=\"dia_termino\"  type='text' name='dia_termino' placeholder='Dia término' >
</div> 
<div>
<button type='submit' class=\"btn btn-outline-primary\">Incluir <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-calendar-plus\" viewBox=\"0 0 16 16\">
<path d=\"M8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7z\"/>
<path d=\"M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z\"/>
</svg></button>
</div>
</div>





</form>
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

</form>
</body>

</html>