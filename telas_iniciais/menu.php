<?php
include '../ferramentas/validar_login.php';
include '../ferramentas/conexao.php';
require_once '../comum/header.php';

$sql_consulta = $pdo->prepare("SELECT nome,id_empresa,sistema,area_atuacao,excluido FROM empresas where excluido = 'n'");
$sql_consulta->execute();
$result_consulta = $sql_consulta->fetchAll(PDO::FETCH_ASSOC);



$html_inicio = <<<HTML_INICIO
    <div class="container">
        <div class="row h1 text-center">
        <label>Empresas</label></div>
        <div class="row">
            <div class="col">
                <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Sistemas</th>
                        <th scope="col">Atuação</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                </div>
                <tbody>
                
HTML_INICIO;


$content = "";

foreach ($result_consulta as $row) {
    $id = $row['id_empresa'];
    $nome = $row['nome'];
    $sistema = $row['sistema'];
    $area_atuacao = $row['area_atuacao'];
    $content .= "<tr>";
    $content .= "<td>$id</td>";
    $content .= "<td>$nome</td>";
    $content .= "<td>$sistema</td>";
    $content .= "<td>$area_atuacao</td>";
    $content .= "<td style=\"width: 5%\"><a title=\"Clique para ver\" href=\"/empresas/empresa.php?id_empresa=$id\" class=\"btn btn-sm btn-outline-primary\"><i class=\"fas fa-eye\"></i></a></td>";
    $content .= "</tr>";
}

$html_fim = <<<HTML_FIM
    </tbody>
    </table>
    </div>
    </div>
    <div class="text-end">
    <a href="/empresas/incluir.php" class="btn btn-outline-primary" title="Incluir uma nova empresa"><i class="fas fa-plus-circle"></i></a>
    </div>
    
    
                   
HTML_FIM;


echo $html_inicio . $content . $html_fim;

?>
</body>

</html>