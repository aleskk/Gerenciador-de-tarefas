<?php
include '../ferramentas/validar_login.php';
include '../ferramentas/conexao.php';
require_once '../comum/header.php';
$id_contatos = $_GET['id_contatos'];
$sql_contatos = $pdo->prepare("SELECT id_contatos,nome,telefone,email,setor FROM contatos where id_contatos = :id_contatos");
$sql_contatos->bindValue(':id_contatos', $id_contatos);
$sql_contatos->execute();
$result_contatos = $sql_contatos->fetchAll(PDO::FETCH_ASSOC);

if (empty($id_contatos)) {
    echo 'tem algo errado que não está certo';
} else {
    foreach ($result_contatos as $row_contatos) {
        $id_contatos = $row_contatos['id_contatos'];
        $nome_contatos = $row_contatos['nome'];
        $telefone = $row_contatos['telefone'];
        $email = $row_contatos['email'];

        $setor = $row_contatos['setor'];
        echo "<p> Nome: $nome_contatos<br> Telefone: $telefone<br> Email: $email<br>Setor: $setor</p><br><a href='editar.php?id_contatos=" . $id_contatos . "'>Editar</a><br><a href='/action/excluir_contato.php?id_contatos=" . $id_contatos . "'>Excluir</a><br>
        <a href='/telas_iniciais/menu.php'>Volte para o inicio</a>";
    }
}
?>
</body>

</html>