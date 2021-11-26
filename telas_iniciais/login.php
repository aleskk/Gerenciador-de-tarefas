
<?php

if (session_id() == "") {
  session_start();}
//Para conectar esta página e puxar os dados do banco de dados que foi conectado nessa página
include '../ferramentas/conexao.php';


//Variáveis para pegar as informações que o usuário digitou
$nome = $_POST['nome'];
$senha = $_POST['senha'];

// Valida se existe o usuário que foi digitado e a senha existe no banco de dados 

$sql = $pdo->prepare("SELECT usuario,id,senha FROM usuarios WHERE usuario = :nome");
$sql->bindValue(':nome', $nome);
$sql->execute();
$resultado_hash = $sql->fetch(PDO::FETCH_ASSOC);
$senha_hash = $resultado_hash['senha'];

if (password_verify($senha, $senha_hash)) {

  $sql = $pdo->prepare("SELECT usuario,id,senha FROM usuarios WHERE usuario = :nome AND senha = :senha");

  //Atribuindo um valor as váriaveis 
  $sql->bindValue(':nome', $nome);
  $sql->bindValue(':senha', $senha_hash);

  //Executando
  $sql->execute();

  //Retornar as informações que foram recebidas, ou seja a validação
  $result = $sql->fetch(PDO::FETCH_ASSOC);

  if ($result) {
    header('Location: menu.php');
  } else {
    header('Location:../index.php');
  }

var_dump($result);
  //Sessões para validação em outras páginas
  $_SESSION['campos_login_nome'] = $nome;
  $_SESSION['login'] = $result['id'];
  $id_usuario = $result['id'];
  include_once __DIR__ . '/../comum/acessos.php';
} else {
  header('Location:../index.php');
}
