<?php
include '../ferramentas/validar_login.php';
include '../ferramentas/conexao.php';
require_once '../comum/header.php';
include_once '../comum/tipos_acesso.php';


// Pegando as informações do usuário

$id_usuario = $_GET['id'];
$sql = $pdo->prepare("SELECT id, usuario,email FROM usuarios where id = :id_usuario");
$sql->bindValue(':id_usuario', $id_usuario);
$sql->execute();

$dados_usuario = $sql->fetch(PDO::FETCH_ASSOC);


// Pegando os acessos que o usuário tem

$sql = $pdo->prepare("SELECT id_acessos FROM acesso where id_usuario = :id_usuario");
$sql->bindValue(':id_usuario', $id_usuario);
$sql->execute();

$acessos_usuario = $sql->fetchAll(PDO::FETCH_COLUMN);

 
// Colocando valores nos acessos e vendo se o usuário escolhido tem ou não

$adm = in_array(TipoAcesso::ADM, $acessos_usuario);
$visualizar_empresa = in_array(TipoAcesso::VISUALIZAR_EMPRESA, $acessos_usuario);
$incluir_empresa = in_array(TipoAcesso::INCLUIR_EMPRESA, $acessos_usuario);
$editar_empresa = in_array(TipoAcesso::EDITAR_EMPRESA, $acessos_usuario);
$excluir_empresa = in_array(TipoAcesso::EXCLUIR_EMPRESA, $acessos_usuario);
$visualizar_contatos = in_array(TipoAcesso::VISUALIZAR_CONTATOS, $acessos_usuario);
$incluir_contatos = in_array(TipoAcesso::INCLUIR_CONTATOS, $acessos_usuario);
$editar_contatos = in_array(TipoAcesso::EDITAR_CONTATOS, $acessos_usuario);
$excluir_contatos = in_array(TipoAcesso::EXCLUIR_CONTATOS, $acessos_usuario);
$visualizar_usuarios = in_array(TipoAcesso::VISUALIZAR_USUARIOS, $acessos_usuario);
$incluir_usuarios = in_array(TipoAcesso::INCLUIR_USUARIOS, $acessos_usuario);
$editar_usuarios = in_array(TipoAcesso::EDITAR_USUARIOS, $acessos_usuario);
$excluir_usuarios = in_array(TipoAcesso::EXCLUIR_USUARIOS, $acessos_usuario);
$visualizar_agenda = in_array(TipoAcesso::VISUALIZAR_AGENDA, $acessos_usuario);
$incluir_agenda = in_array(TipoAcesso::INCLUIR_AGENDA, $acessos_usuario);
$editar_agenda = in_array(TipoAcesso::EDITAR_AGENDA, $acessos_usuario);
$excluir_agenda = in_array(TipoAcesso::EXCLUIR_AGENDA, $acessos_usuario);

// Verificar se o usuário que está logado tem acesso a editar

$id_usuario_logado=$_SESSION['login'];
$sql_logado= $pdo->prepare("SELECT id_acessos FROM acesso WHERE id_usuario = :id_usuario_logado");
$sql_logado->bindValue(':id_usuario_logado',$id_usuario_logado);
$sql_logado->execute();
$acessos_usuario_logado=$sql_logado->fetchAll(PDO::FETCH_COLUMN);
$editar_usuarios_logado = in_array(TipoAcesso::EDITAR_USUARIOS, $acessos_usuario_logado);


// Vendo se o usuário que está tentando editar tem ou não o acesso para isso

if(!$editar_usuarios_logado){
  echo "<script>
  Swal.fire({
    icon: 'error',
    title: 'Você não tem permissão de acessar essa área',
    showConfirmButton: false,
  
  })</script>";
}



  echo "
     
  <div class=\"container\" >
  <div class=\"row g-3\">
    <div class=\"col\">
    <form method='POST' action='/action/editar_usuario.php?id=" . $id_usuario . "'>
      <h1 class=\"mb-3\" >Editar usuario</h1>
  
      <div class=\"mb-3\">
      <label for=\"usuario\" class=\"h3\" >Nome do usuario</label>
      <input class=\"form-control\" id=\"usuario\" input type='text' name='usuario' placeholder='Nome do usuário' value=" . $dados_usuario['usuario'] . ">
      </div>
      <div class=\"mb-3\">
      <label for=\"email\" class=\"h3\" >E-mail</label>
      <input class=\"form-control\" id=\"email\" input type='email' name='email' placeholder='E-mail' value=" . $dados_usuario['email'] . ">
      </div>
    <div>
    
    <label class=\"h3\">Acessos</label>
    <br>
    ";
 
      // ADM
      echo "
      
      <div class=\"form-check form-switch form-check-inline\">
        <input class=\"form-check-input\" type=\"checkbox\" name=\"acessos[]\" role=\"switch\" id=\"adm\" value=\"19\" ";
  
    if ($adm) {
      echo "checked";
    }
    echo "
        <label class=\"form-check-label\" for=\"adm\">adm</label>
      </div>";
  
 echo "
    <div>
      <label>Empresas</label>
      ";

  //Visualizar empresa


  echo "
    <div class=\"form-check form-switch form-check-inline\">
      <input class=\"form-check-input\" type=\"checkbox\" name=\"acessos[]\" role=\"switch\" id=\"visualizar_emp\" value=\"3\" ";

  if ($visualizar_empresa) {
    echo "checked";
  }
  echo "> 
      <label class=\"form-check-label\" for=\"visualizar_emp\">Visualizar</label>
    </div>";

  //Incluir empresa

  echo "
  <div class=\"form-check form-switch form-check-inline\">
    <input class=\"form-check-input\" type=\"checkbox\" name=\"acessos[]\" role=\"switch\" id=\"incluir_emp\" value=\"9\" ";

  if ($incluir_empresa) {
    echo "checked";
  }
  echo "> 
    <label class=\"form-check-label\" for=\"incluir_emp\">Incluir</label>
  </div>";

  //Editar empresa

  echo "
  <div class=\"form-check form-switch form-check-inline\">
    <input class=\"form-check-input\" type=\"checkbox\" name=\"acessos[]\" role=\"switch\" id=\"editar_empresa\" value=\"6\" ";

  if ($editar_empresa) {
    echo "checked";
  }
  echo "> 
    <label class=\"form-check-label\" for=\"editar_empresa\">Editar</label>
  </div>";

  //Excluir empresa

  echo "
  <div class=\"form-check form-switch form-check-inline\">
    <input class=\"form-check-input\" type=\"checkbox\" name=\"acessos[]\" role=\"switch\" id=\"excluir_empresa\" value=\"17\" ";

  if ($excluir_empresa) {
    echo "checked";
  }
  echo "> 
    <label class=\"form-check-label\" for=\"excluir_empresa\">Excluir</label>
  </div>
</div>";
  echo "
<div>
  <label>Contatos</label>
  ";

  //Visualizar contatos

  echo "
    <div class=\"form-check form-switch form-check-inline\">
      <input class=\"form-check-input\" type=\"checkbox\" name=\"acessos[]\" role=\"switch\" id=\"visualizar_cont\" value=\"4\" ";

  if ($visualizar_contatos) {
    echo "checked";
  }
  echo "> 
      <label class=\"form-check-label\" for=\"visualizar_cont\">Visualizar</label>
    </div>";

  //Incluir contatos

  echo "
    <div class=\"form-check form-switch form-check-inline\">
      <input class=\"form-check-input\" type=\"checkbox\" name=\"acessos[]\" role=\"switch\" id=\"incluir_cont\" value=\"10\" ";

  if ($incluir_contatos) {
    echo "checked";
  }
  echo "> 
      <label class=\"form-check-label\" for=\"incluir_cont\">Incluir</label>
    </div>";

  // Editar contato

  echo "
    <div class=\"form-check form-switch form-check-inline\">
      <input class=\"form-check-input\" type=\"checkbox\" name=\"acessos[]\" role=\"switch\" id=\"editar_cont\" value=\"7\" ";

  if ($editar_contatos) {
    echo "checked";
  }
  echo "> 
      <label class=\"form-check-label\" for=\"editar_cont\">Editar</label>
    </div>";

  //Excluir contatos

  echo "
    <div class=\"form-check form-switch form-check-inline\">
      <input class=\"form-check-input\" type=\"checkbox\" name=\"acessos[]\" role=\"switch\" id=\"excluir_cont\" value=\"16\" ";

  if ($excluir_contatos) {
    echo "checked";
  }
  echo ">
      <label class=\"form-check-label\" for=\"excluir_cont\">Excluir</label>
    </div>
  </div>";
  echo "
<div>
  <label>Usuários</label>
  ";

  // Visualizar usuarios

  echo "
  <div class=\"form-check form-switch form-check-inline\">
    <input class=\"form-check-input\" type=\"checkbox\" name=\"acessos[]\" role=\"switch\" id=\"visualizar_user\" value=\"12\" ";

  if ($visualizar_usuarios) {
    echo "checked";
  }
  echo "> 
    <label class=\"form-check-label\" for=\"visualizar_user\">Visualizar</label>
  </div>";

  //Incluir usuarios

  echo "
  <div class=\"form-check form-switch form-check-inline\">
    <input class=\"form-check-input\" type=\"checkbox\" name=\"acessos[]\" role=\"switch\" id=\"incluir_user\" value=\"14\" ";

  if ($incluir_usuarios) {
    echo "checked";
  }
  echo "> 
    <label class=\"form-check-label\" for=\"incluir_user\">Incluir</label>
  </div>";

  // Editar usuarios

  echo "
  <div class=\"form-check form-switch form-check-inline\">
    <input class=\"form-check-input\" type=\"checkbox\" name=\"acessos[]\" role=\"switch\" id=\"editar_usuarios\" value=\"13\" ";

  if ($editar_usuarios) {
    echo "checked";
  }
  echo "> 
    <label class=\"form-check-label\" for=\"editar_usuarios\">Editar</label>
  </div>";

  // Excluir usuarios

  echo "
  <div class=\"form-check form-switch form-check-inline\">
    <input class=\"form-check-input\" type=\"checkbox\" name=\"acessos[]\" role=\"switch\" id=\"excluir_usuarios\" value=\"15\" ";

  if ($excluir_usuarios) {
    echo "checked";
  }
  echo "> 
    <label class=\"form-check-label\" for=\"excluir_usuarios\">Excluir</label>
  </div>
  </div>";
  
  echo "
<div>
  <label>Agenda</label>
";

  // Visualizar Agenda

  echo "
    <div class=\"form-check form-switch form-check-inline\">
      <input class=\"form-check-input\" type=\"checkbox\" name=\"acessos[]\" role=\"switch\" id=\"visualizar_agenda\" value=\"5\" ";

  if ($visualizar_agenda) {
    echo "checked";
  }
  echo "> 
      <label class=\"form-check-label\" for=\"visualizar_agenda\">Visualizar</label>
    </div>";

  // Incluir Agenda

  echo "
  <div class=\"form-check form-switch form-check-inline\">
    <input class=\"form-check-input\" type=\"checkbox\" name=\"acessos[]\" role=\"switch\" id=\"incluir_agenda\" value=\"11\" ";

  if ($incluir_agenda) {
    echo "checked";
  }
  echo "> 
    <label class=\"form-check-label\" for=\"incluir_agenda\">Incluir</label>
  </div>";

  // Editar Agenda

   echo "
  <div class=\"form-check form-switch form-check-inline\">
    <input class=\"form-check-input\" type=\"checkbox\" name=\"acessos[]\" role=\"switch\" id=\"editar_agenda\" value=\"8\" ";

  if ($editar_agenda) {
    echo "checked";
  }
  echo "> 
    <label class=\"form-check-label\" for=\"editar_agenda\">Editar</label>
  </div>";

  // Excluir Agenda

  echo "
  <div class=\"form-check form-switch form-check-inline\">
    <input class=\"form-check-input\" type=\"checkbox\" name=\"acessos[]\" role=\"switch\" id=\"excluir_agenda\" value=\"18\" ";

  if ($excluir_agenda) {
    echo "checked";
  }
  echo "> 
    <label class=\"form-check-label\" for=\"excluir_agenda\">Excluir</label>
  </div>";

  

  //Botões

  echo "
</div>
</div><br>
<div class=\"col-12\">
  <button type='submit' class=\"btn btn-lg btn-outline-primary\">Salvar <i class=\"fas fa-user-check\"></i></button>
</div>       
  </form>
</div>
</div>
    ";


?>
</body>

</html>