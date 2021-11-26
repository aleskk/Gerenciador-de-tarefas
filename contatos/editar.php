<?php
include '../ferramentas/validar_login.php';
include '../ferramentas/conexao.php';
require_once '../comum/header.php';

include_once '../comum/tipos_acesso.php';

$acessos = $_SESSION['acessos'];
$id_contatos = $_GET['id_contatos'];

if ($acessos[TipoAcesso::EDITAR_CONTATOS]) {
  $sql_contatos = $pdo->prepare("SELECT id_contatos,nome,telefone,email,setor FROM contatos where id_contatos = :id_contatos");
  $sql_contatos->bindValue(':id_contatos', $id_contatos);
  $sql_contatos->execute();
  $result_contatos = $sql_contatos->fetchAll(PDO::FETCH_ASSOC);
  foreach ($result_contatos as $row_contatos) {
    $id_contatos = $row_contatos['id_contatos'];
    $nome_contatos = $row_contatos['nome'];
    $telefone = $row_contatos['telefone'];
    $email = $row_contatos['email'];
    $setor = $row_contatos['setor'];
  }
  echo "
    
       
  <div class=\"container\" >
  <div class=\"row g-3\">
    <div class=\"col\">
    <form method='POST' action='/action/editar_contato.php?id_contatos=" . $id_contatos . "'>
    <h1>Editar contato</h1>
    <div class=\"mb-3\" >
      <label for=\"nome\" class=\"form-label\" >Nome</label>
      <input class=\"form-control\" id=\"nome\" type='text' name='nome' placeholder='Nome' value=" . $nome_contatos . ">
    </div>
    <div class=\"mb-3\">
      <label for=\"telefone\" class=\"form-label\">Telefone</label>
      <input class=\"form-control\" id=\"mensalidade\" type='number' name='telefone' placeholder='Telefone' value=" . $telefone . ">
    </div>
    <div class=\"mb-3\">
      <label for=\"email\" class=\"form-label\">E-mail</label>
      <input class=\"form-control\" id=\"email\"  type='email' name='email' placeholder='E-mail' value=" . $email . ">
    </div>   
    <div class=\"mb-3\">
      <label for=\"setor\" class=\"form-label\">Setor</label>
      <input class=\"form-control\" id=\"setor\"  type='text' name='setor' placeholder='Setor' value=" . $setor . ">
    </div>
    
    <div class=\"mb-3\">
    <button type='submit' class=\"btn btn-outline-primary\">Salvar <i class=\"fas fa-check\"></i></button>
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