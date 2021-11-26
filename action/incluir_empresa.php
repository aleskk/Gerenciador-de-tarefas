<?php
include '../ferramentas/validar_login.php';
require_once '../comum/header.php';
include_once '../ferramentas/conexao.php';


$nome = $_POST['nome'];
$area_atuacao = $_POST['area_atuacao'];
$sistema = $_POST['sistema'];
$valor_mensalidade = $_POST['mensalidade'];
$dia_pagamento = $_POST['dia_pagamento'];
$mapeamento = $_POST['mapeamento'];
$servidor = $_POST['servidor'];
$cnpj = $_POST['cnpj'];
$site = $_POST['site'];


function validar_cnpj($cnpj)
{
  $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);

  // Valida tamanho
  if (strlen($cnpj) != 14)
    return false;

  // Verifica se todos os digitos são iguais
  if (preg_match('/(\d)\1{13}/', $cnpj))
    return false;

  // Valida primeiro dígito verificador
  for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++) {
    $soma += $cnpj[$i] * $j;
    $j = ($j == 2) ? 9 : $j - 1;
  }

  $resto = $soma % 11;

  if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto))
    return false;

  // Valida segundo dígito verificador
  for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++) {
    $soma += $cnpj[$i] * $j;
    $j = ($j == 2) ? 9 : $j - 1;
  }

  $resto = $soma % 11;

  return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
}

$cnpj_validada = validar_cnpj($cnpj);

if ($cnpj_validada) {
  $sql_incluir_empresa = $pdo->prepare("INSERT INTO empresas (nome,area_atuacao ,sistema ,valor_mensalidade ,dia_pagamento ,mapeamento ,servidor ,cnpj ,site) values (:nome,:area_atuacao,:sistema,:valor_mensalidade,:dia_pagamento,:mapeamento,:servidor,:cnpj,:site)");
  $sql_incluir_empresa->bindValue(':nome', $nome);
  $sql_incluir_empresa->bindValue(':area_atuacao', $area_atuacao);
  $sql_incluir_empresa->bindValue(':sistema', $sistema);
  $sql_incluir_empresa->bindValue(':valor_mensalidade', $valor_mensalidade);
  $sql_incluir_empresa->bindValue(':dia_pagamento', $dia_pagamento);
  $sql_incluir_empresa->bindValue(':mapeamento', $mapeamento);
  $sql_incluir_empresa->bindValue(':servidor', $servidor);
  $sql_incluir_empresa->bindValue(':cnpj', $cnpj_validada);
  $sql_incluir_empresa->bindValue(':site', $site);
  $sql_incluir_empresa->execute();
  $resultado = $sql_incluir_empresa->execute();
  echo "<script>Swal.fire({
    position: 'top',
     icon: 'success',
     title: 'Empresa cadastrada com sucesso',
     showConfirmButton: true,
     confirmButtonText: '<a class=\"link-light\" href=\"/telas_iniciais/menu.php\">Ok</a>',
     allowOutsideClick: false,
     
})
     </script>
    ";
} else {
  echo "<script>
  Swal.fire({
    icon: 'error',
    title: 'CNPJ inválida',
  })</script>";
}
