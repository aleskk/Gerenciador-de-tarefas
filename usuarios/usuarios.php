<?php
include '../ferramentas/validar_login.php';
include '../ferramentas/conexao.php';
require_once '../comum/header.php';
include_once '../comum/tipos_acesso.php';

$acessos = $_SESSION['acessos'];

// Verificando se o usuário tem acesso 

if ($acessos[TipoAcesso::VISUALIZAR_USUARIOS]) {

    $sql = $pdo->prepare("SELECT id,usuario,senha,email FROM usuarios where excluido = 'N'");
    $sql->execute();
    $result_user = $sql->fetchAll(PDO::FETCH_ASSOC);


    $html_inicio_user = <<<HTML_INICIO
<tbody>
<div class = "container">
    <div class="row">
        <div class="col">
            <div class="text-center h1">
                <label>Usuários</label></div>
            <table class="table table-hover" id="tabela">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Usuário</th>
                    <th scope="col">E-mail</th>
                    <th colspan="2" class="text-center">Ações</th>
                </tr>
            </tbody>
            </thead>
            <tbody>
            
HTML_INICIO;


    $content_user = "";

    foreach ($result_user as $row_user) {
        $id = $row_user['id'];
        $usuario = $row_user['usuario'];
        $email = $row_user['email'];
        $content_user .= "<tr id=\"linha" . $id . "\"><th scope=\"row\">$id</th>";
        $content_user .= "<td>$usuario</td>";
        $content_user .= "<td>$email</td>";
        $content_user .= "<td style=\"width: 5%\"><a href=\"/usuarios/editar.php?id=$id\" class=\"btn btn-sm btn-outline-primary\"><i class=\"fas fa-pencil-alt\"></i></td> 
        <td style=\"width: 5%\">
            <form onsubmit=\"excluir(event)\">
                <input type=\"hidden\" name=\"id\" value=\"$id\"  />
                
                <button type=\"submit\" class=\"btn btn-sm btn-outline-danger\"><i class=\"fas fa-trash-alt\"></i></button>
            </form>        
        ";
    }

    $html_fim_user = <<<HTML_FIM
    </tbody>
    </table>
    </div>
    </div>
    <div class="row">
        <div class="col text-end">
            <a href="/usuarios/incluir.php" class="btn btn-outline-primary"><i class="fas fa-fw fa-plus-circle"></i></a>
        </div>
    </div>  
    </div>    
            
HTML_FIM;

    echo "$html_inicio_user  $content_user  $html_fim_user";
} else {
    echo "<script>
  Swal.fire({
    icon: 'error',
    title: 'Você não tem permissão de acessar essa área',
    showConfirmButton: false,
  
  })</script>";
}
?>

<!-- Confirmar se quer excluir ou não-->

<script>
    function excluir(event) {
        event.preventDefault();
        var idUsuario = event.target.id.value;

        Swal.fire({
            title: 'Você tem certeza que quer deletar este usuário?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirmar exclusão',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {




                fetch('/action/excluir_usuario.php', {
                    method: 'POST',
                    headers: {
                        "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
                    },
                    body: 'id=' + idUsuario
                }).then(() => {

                    var linha = document.getElementById("linha" + idUsuario);
                    var i = linha.rowIndex;
                    document.getElementById("tabela").deleteRow(i);

                    Swal.fire({
                        position: 'top',
                        icon: 'success',
                        title: 'Usuário excluído',
                        showConfirmButton: false,
                        timer: 1000
                    })
                })
            }
        })
    }
</script>
</body>

</html>