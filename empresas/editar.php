<?php
include '../ferramentas/validar_login.php';
require_once '../comum/header.php';
include '../ferramentas/conexao.php';
include_once '../comum/tipos_acesso.php';

$acessos = $_SESSION['acessos'];


if ($acessos[TipoAcesso::EDITAR_EMPRESA]) {

    $id = $_GET['id_empresa'];
    $sql_empresa = $pdo->prepare("SELECT id_empresa,nome,area_atuacao,sistema,valor_mensalidade,dia_pagamento,mapeamento,servidor,cnpj,site FROM empresas where id_empresa = :id_empresa");
    $sql_empresa->bindValue(':id_empresa', $id);
    $sql_empresa->execute();
    $result_empresa = $sql_empresa->fetchAll(PDO::FETCH_ASSOC);


    if (empty($id)) {
        echo 'tem algo errado que não está certo';
    } else {

        foreach ($result_empresa as $row) {
            $nome_empresa = $row['nome'];
            $area_atuacao = $row['area_atuacao'];
            $sistema = $row['sistema'];
            $mensalidade = $row['valor_mensalidade'];
            $dia_pagamento = $row['dia_pagamento'];
            $mapeamento = $row['mapeamento'];
            $servidor = $row['servidor'];
            $cnpj = $row['cnpj'];
            $site = $row['site'];
            echo "
<div class=\"container\" >
        <div class=\"row g-3\">
            <div class=\"col\">

                <form method='POST' action='/action/editar_empresa.php?id_empresa=" . $id . "'>

                    <h1 class=\"editar\">Editar</h1>
                    <div class=\"mb-3\">
                        <label for=\"name\" class=\"form-label\">Nome</label>
                        <input type=\"text\" name=\"nome\" id=\"name\" placeholder=\"Nome\" required class=\"form-control\" autofocus value=" . $nome_empresa . ">
                    </div>
                    <div class=\"mb-3\">
                        <label for=\"area_atuacao\" class=\"form-label\">Área de atuação</label>
                        <input type=\"text\" name=\"area_atuacao\" id=\"area_atuacao\" placeholder=\"Área de atuação\" required class=\"form-control\" value=" . $area_atuacao . ">
                    </div>
                    <div class=\"mb-3\">
                        <label for=\"sistema\" class=\"form-label\">Sistema</label>
                        <input type=\"text\" name=\"sistema\" id=\"area_atuacao\" placeholder=\"Sistema\" required class=\"form-control\" value=" . $sistema . ">
                    </div>
                    <div class=\"mb-3\">
                        <label for=\"mensalidade\" class=\"form-label\">Valor da mensalidade</label>
                        <input class=\"form-control\" type=\"text\" name=\"mensalidade\" id=\"mensalidade\" placeholder=\"Mensalidade\" value=" . $mensalidade . " >
                    </div>
                    <div class=\"mb-3\">
                        <label for=\"dia_pagamento\" class=\"form-label\" >Dia do pagamento</label>
                        <input type=\"text\" name=\"dia_pagamento\" id=\"dia_pagamento\" placeholder=\"Dia de pagamento\" value=" . $dia_pagamento . " class=\"form-control\" size=2 maxlength=2>
                    </div>
                    <div class=\"mb-3\">
                        <label for=\"mapeamento\" class=\"form-label\" >Mapeamento</label>
                        <input type=\"text\" name=\"mapeamento\" id=\"mapeamento\" placeholder=\"Mapeamento\" required class=\"form-control\" value=" . $mapeamento . " size=1 maxlength=1>
                    </div>
                    <div class=\"mb-3\">
                        <label for=\"servidor\" class=\"form-label\" >Servidor</label>
                        <input type=\"text\" name=\"servidor\" id=\"servidor\" placeholder=\"Servidor\" value=" . $servidor . " class=\"form-control\">
                    </div><div class=\"mb-3\">
                    <label for=\"cnpj\" class=\"form-label\" >CNPJ</label>
                    <input type=\"text\" name=\"cnpj\" id=\"cnpj\"placeholder=\"##.###.###/####-##\" size=18 maxlength=18 required class=\"form-control\" value=" . $cnpj . ">
                </div><div class=\"mb-3\">
                <label for=\"site\" class=\"form-label\">Site</label>
                <input type=\"text\" name=\"site\" id=\"site\" placeholder=\"Site\" value=" . $site . " class=\"form-control\">
            </div>
                    <button type=\"submit\" class=\"btn btn-outline-primary\">Salvar <i class=\"fas fa-check\"></i></button>
            </div>
        </div>
    </div>

    </form>
    </div>";
        }
    }
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