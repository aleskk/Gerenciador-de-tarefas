<?php
include '../ferramentas/validar_login.php';
include '../ferramentas/conexao.php';
require_once '../comum/header.php';
$id_agenda = $_GET['id_agenda'];
$sql = $pdo->prepare("SELECT id_agenda,tarefa,dia_inicio,dia_termino FROM agenda where id_agenda = :id_agenda");
$sql->bindValue(':id_agenda', $id_agenda);
$sql->execute();
$result = $sql->fetchAll(PDO::FETCH_ASSOC);

if (empty($id_agenda)) {
    echo 'tem algo errado que não está certo';
} else {
    foreach ($result as $row) {
        $id_agenda = $row['id_agenda'];
        $tarefa = $row['tarefa'];
        $dia_inicio = $row['dia_inicio'];
        $dia_termino = $row['dia_termino'];
        echo "<p> Tarefa: $tarefa<br> Dia de inicio: $dia_inicio<br> Dia de término: $dia_termino<br> <a href='editar.php?id_agenda=" . $id_agenda . "'>Editar</a><br><a href='/action/excluir_agenda.php?id_agenda=" . $id_agenda . "'>Excluir</a><br>
        <a href='/telas_iniciais/menu.php'>Volte para o inicio</a>";
    }
}
?>
</body>

</html>