<?php
include '../ferramentas/validar_login.php';
include '../ferramentas/conexao.php';
require_once '../comum/header.php';
include_once '../comum/tipos_acesso.php';

$acessos = $_SESSION['acessos'];


if ($acessos[TipoAcesso::INCLUIR_USUARIOS]) {

  echo "
  <div class=\"container\" >
    <div class=\"row g-3\">
      <div class=\"col\">
        <form class=\"row g-3\" method='POST' action='/action/incluir_usuario.php'>
        <h1>Cadastrar Usuário</h1>
     <div class=\"mb-3\" >
      <label for=\"nome\" class=\"form-label\" >Nome do usuário</label>
      <input class=\"form-control\" id=\"nome\" input type='text' name='nome' placeholder='Nome'>
     </div>
     <div class=\"mb-3\" >
      <label for=\"email\" class=\"form-label\" >E-mail</label>
      <input class=\"form-control\" id=\"email\" input type='email' name='email' placeholder='E-mail'>
      </div>
     <div class=\"mb-3\">
      <label for=\"senha\" class=\"form-label\">Senha</label>
      <input class=\"form-control\" id=\"senha\" type='password' name='senha' placeholder='Senha'>
      </div>
     <div class=\"mb-3\">
      <label for=\"senha2\" class=\"form-label\">Confirme a senha</label>
      <input class=\"form-control\" id=\"senha2\"  type='password' name='senha2' placeholder='Confirme sua senha' >
     </div>
     <div class=\"mb-3\">
      <button type=\"submit\" class=\"btn btn-outline-primary\">Incluir <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-person-plus\" viewBox=\"0 0 16 16\">
      <path d=\"M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1   1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z\"/>
      <path fill-rule=\"evenodd\" d=\"M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z\"/>
      </svg></button>
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