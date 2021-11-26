<?php
include '../ferramentas/validar_login.php';
require_once '../comum/header.php';
include_once '../ferramentas/conexao.php';

$id_usuario = $_GET['id'];
$usuario = $_POST['usuario'];
$email = $_POST['email'];
$acessos_concedidos = $_POST['acessos'] ?? [];


$sql_editar_usuario = $pdo->prepare('UPDATE usuarios SET usuario = :usuario, email = :email
    WHERE id= :id');

$sql_editar_usuario->bindValue(':usuario', $usuario);
$sql_editar_usuario->bindValue(':id', $id_usuario);
$sql_editar_usuario->bindValue(':email', $email);
$sql_editar_usuario->execute();

$stmt = $pdo->prepare('DELETE FROM acesso WHERE id_usuario = :id_usuario ');
$stmt->bindValue(':id_usuario', $id_usuario);
$stmt->execute();


$sql_users = $pdo->prepare("INSERT INTO acesso (id_acessos, id_usuario) values (:id_acessos, :id_usuario)");

foreach ($acessos_concedidos as $id_acesso) {

  $sql_users->bindValue(':id_acessos', $id_acesso);
  $sql_users->bindValue(':id_usuario', $id_usuario);
  $sql_users->execute();
}
echo "<script>Swal.fire({
  position: 'top',
   icon: 'success',
   title: 'Usuário alterado com sucesso',
   showConfirmButton: true,
   confirmButtonText: '<a class=\"link-light\" href=\"/telas_iniciais/menu.php\">Ok</a>',
   allowOutsideClick: false,
   
})
   </script>
  ";
