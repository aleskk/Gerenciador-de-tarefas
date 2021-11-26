<?php
include '../ferramentas/validar_login.php';
include '../ferramentas/conexao.php';
require_once '../comum/header.php';
include_once '../comum/tipos_acesso.php';

$acessos = $_SESSION['acessos'];

// Empresa

if ($acessos[TipoAcesso::VISUALIZAR_EMPRESA]) {

  $id_empresa = $_GET['id_empresa'];
  $sql_empresa = $pdo->prepare("SELECT id_empresa,nome,area_atuacao,sistema,valor_mensalidade,dia_pagamento,mapeamento,servidor,cnpj,site FROM empresas where id_empresa = :id_empresa and excluido = 'N'");
  $sql_empresa->bindValue(':id_empresa', $id_empresa);
  $sql_empresa->execute();
  $result_empresa = $sql_empresa->fetchAll(PDO::FETCH_ASSOC);

  if (empty($id_empresa)) {
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
      $id_empresa = $row['id_empresa'];

      echo "
<div class=\"container\">
    <form class=\"row g-3\">
    <div class=\"col-md-6\">
    <div class=\"card-body\">
    <label class=\"card-title h1\">$nome_empresa</label>
    <h5 class=\"h5 card-subtitle text-muted \">$area_atuacao</h5></li>
    </div>
    </div>
    <div class=\"col-md-6 h5\">
      <label for=\"sistema\" class=\"form-label\" >Sistema</label>
      <input type=\"text\" class=\"form-control\" id=\"sistema\" value=" . $sistema . " readonly=\"true\">
    </div>
    <div class=\"col-md-6 h5\">
      <label for=\"mensalidade\" class=\"form-label\">Mensalidade</label>
      <input type=\"text\" class=\"form-control\" id=\"mensalidade\" value=R$" . $mensalidade . " readonly=\"true\">
    </div>
    <div class=\"col-md-6 h5\">
      <label for=\"dia_pagamento\" class=\"form-label\">Dia de pagamento</label>
      <input type=\"text\" class=\"form-control\" id=\"dia_pagamento\"  value=" . $dia_pagamento . " readonly=\"true\">
    </div>
    <div class=\"col-md-6 h5\">
      <label for=\"mapeamento\" class=\"form-label\">Mapeamento de rede</label>
      <input type=\"text\" class=\"form-control\" id=\"mapeamento\"  value=" . $mapeamento . " readonly=\"true\">
      </div>    
    <div class=\"col-md-6 h5\">
      <label for=\"servidor\" class=\"form-label\">Máquina servidor</label>
      <input type=\"text\" class=\"form-control\" id=\"servidor\"  value=" . $servidor . " readonly=\"true\">
    </div>
    <div class=\"col-md-6 h5\">
      <label for=\"cnpj\" class=\"form-label\">CNPJ</label>
      <input type=\"text\" class=\"form-control\" id=\"cnpj\" value= " . $cnpj . " readonly=\"true\">
    </div>
    <div class=\"col-md-6 h5\">
      <label for=\"site\" class=\"form-label\">Site</label>
      <input type=\"text\" class=\"form-control\" id=\"site\"  value=" . $site . " readonly=\"true\">
    </div>
 <div class=\"col-12\">
    <a href=\"editar.php?id_empresa=" . $id_empresa . "\" class=\"btn btn-outline-primary\">Editar <i class=\"fas fa-pencil-alt\"></i></a><br><br>
    
   </form>
  
 
 <form onsubmit=\"excluirEmpresa(event)\" >
  <input type=\"hidden\" name = \"id_empresa\" value=\"$id_empresa\">
  <button type=\"submit\" class=\"btn btn-outline-danger\">Excluir <i class=\"fas fa-trash-alt\"></i></button> 
</form> 
  
    
 
  



  ";
    }

    // Contatos

    if ($acessos[TipoAcesso::VISUALIZAR_CONTATOS]) {
      $sql_list = $pdo->prepare("SELECT nome,id_empresa,id_contatos,telefone,setor,email FROM contatos where id_empresa = :id_empresa and excluido = 'N'");
      $sql_list->bindValue(':id_empresa', $id_empresa);
      $sql_list->execute();
      $result_cont = $sql_list->fetchAll(PDO::FETCH_ASSOC);


      $html_inicio_cont = <<<HTML_INICIO
    <br>
    <hr>
    <tbody>
    <div>
        <div class="row">
            <div class="col">
            
            <div class="h1 text-center"><label>Contatos</label></div>
                <table class="table table-hover" id="tabela">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Setor</th>
                        <th scope="col">Email</th>
                        <th colspan="2" class="text-center"> Ações</th>
                    </tr>
                </tbody>
                </thead>
                <tbody>
                
HTML_INICIO;


      $content_cont = "";

      foreach ($result_cont as $row_cont) {
        $id_empresa = $row_cont['id_empresa'];
        $id_contatos = $row_cont['id_contatos'];
        $nome = $row_cont['nome'];
        $setor = $row_cont['setor'];
        $email = $row_cont['email'];
        $telefone = $row_cont['telefone'];
        $content_cont .= "<tr id=\"linhaContato" . $id_empresa . "_" . $id_contatos . "\"><th scope=\"row\">$id_contatos</th>";
        $content_cont .= "<td>$nome</td>";
        $content_cont .= "<td>$telefone</td>";
        $content_cont .= "<td>$setor</td>";
        $content_cont .= "<td>$email</td>";
        $content_cont .= "
        <td style=\"width: 5%\">
          <a href=\"/contatos/editar.php?id_empresa=$id_empresa&id_contatos=$id_contatos\" class=\"btn btn-sm btn-outline-primary\"><i class=\"fas fa-pencil-alt\"></td> 
        <td style=\"width: 5%\">
          <form onsubmit=\"excluirContato(event)\">
            <input type=\"hidden\" name=\"id_empresa\"value=\"$id_empresa\">
            <input type=\"hidden\" name=\"id_contato\" value=\"$id_contatos\">
            <button type=\"submit\" class=\"btn btn-sm btn-outline-danger\"><i class=\"fas fa-trash-alt\"></i></button> 
          </form>
        </td>    ";
      }

      $html_fim_cont = <<<HTML_FIM
    </tbody>
    </table>
    </div>
    </div>   
    </div>
    <div class="row">
        <div class="col text-end">
            <a href="/contatos/incluir.php?id_empresa=$id_empresa" class="btn btn-outline-primary" title="Incluir novo contato"><i class="fas fa-plus-circle"></i></a>
        </div>
    </div>   
            
HTML_FIM;

      echo $html_inicio_cont . $content_cont . $html_fim_cont;
    }

    // Agenda

    if ($acessos[TipoAcesso::VISUALIZAR_AGENDA]) {

      $sql_list_agenda = $pdo->prepare("SELECT id_agenda,tarefa,dia_inicio,dia_termino FROM agenda where id_empresa = :id_empresa and excluido = 'N'");
      $sql_list_agenda->bindValue(':id_empresa', $id_empresa);
      $sql_list_agenda->execute();
      $result_agenda = $sql_list_agenda->fetchAll(PDO::FETCH_ASSOC);


      $html_inicio_agenda = <<<HTML_INICIO
    <br>
    <hr>
        <div class="row h1 text-center"><label>Agenda</label></div>
        <div class="row">
            <div class="col">
            
                <table id="tabelaAgenda" class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Tarefa</th>
                        <th scope="col">Dia de início</th>
                        <th scope="col">Dia de término</th>
                        <th colspan="2" class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                
HTML_INICIO;


      $content_agenda = "";

      foreach ($result_agenda as $row_agenda) {
        $id_agenda = $row_agenda['id_agenda'];
        $tarefa = $row_agenda['tarefa'];
        $dia_inicio = $row_agenda['dia_inicio'];
        $dia_termino = $row_agenda['dia_termino'];
        $content_agenda .= "<tr id=\"linhaAgenda" . $id_empresa . "_" . $id_agenda . "\"><th scope=\"row\">$id_agenda</th>";
        $content_agenda .= "<td>$tarefa</td>";
        $content_agenda .= "<td>$dia_inicio</td>";
        $content_agenda .= "<td>$dia_termino</td>";
        $content_agenda .= "
        <td style=\"width: 5%\">
          <a href=\"/agenda/editar.php?id_empresa=$id_empresa&id_agenda=$id_agenda\" class=\"btn btn-sm btn-outline-primary\"><i class=\"fas fa-pencil-alt\"></i>
        </td> 
        <td style=\"width: 5%\">
          <form onsubmit=\"excluir(event)\">
            <input type=\"hidden\" name=\"id_empresa\" value=\"$id_empresa\" />
            <input type=\"hidden\" name=\"id_agenda\" value=\"$id_agenda\" />
            <button class=\"btn btn-sm btn-outline-danger \" type=\"submit\"><i class=\"fas fa-trash-alt\"></i></button>
        </form>
       ";
      }

      $html_fim_agenda = <<<HTML_FIM
      
    </tbody>
    </table>
    </div>    
     </div>  
        <div class="col text-end">
            <a href="/agenda/incluir.php?id_empresa=$id_empresa" class="btn btn-outline-primary" title="Incluir nova tarefa"><i class="fas fa-plus-circle"></i></a>
          
        </div>
        </div>  
HTML_FIM;


      echo $html_inicio_agenda . $content_agenda . $html_fim_agenda;
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
<script>
  //Empresa

  function excluirEmpresa(eventEmpresa) {
    eventEmpresa.preventDefault();
    var idEmpresa = event.target.id_empresa.value;

    Swal.fire({
      title: 'Você tem certeza que quer deletar esta Empresa?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Confirmar exclusão',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {

        fetch('/action/excluir_empresa.php', {
          method: 'POST',
          headers: {
            "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
          },
          body: 'id_empresa=' + idEmpresa
        }).then(() => {
          Swal.fire({
            position: 'top',
            icon: 'success',
            title: 'Empresa excluída',
            showConfirmButton: true,
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.assign("/telas_iniciais/menu.php")
            }
          })

        })
      }
    })
  }
  // Contatos 

  function excluirContato(eventContato) {
    eventContato.preventDefault();
    var idContato = eventContato.target.id_contato.value;
    var idEmpresa = eventContato.target.id_empresa.value;

    Swal.fire({
      title: 'Você tem certeza que quer deletar este contato?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Confirmar exclusão',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {

        fetch('/action/excluir_contato.php', {
          method: 'POST',
          headers: {
            "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
          },
          body: 'id_contato=' + idContato + '&id_empresa=' + idEmpresa

        }).then(() => {

          var linhaContato = document.getElementById("linhaContato" + idEmpresa + '_' + idContato);
          var e = linhaContato.rowIndex;
          document.getElementById("tabela").deleteRow(e);

          Swal.fire({
            position: 'top',
            icon: 'success',
            title: 'Contato excluído',
            showConfirmButton: false,
            timer: 1000
          })
        })
      }
    })
  }

  // Agenda

  function excluir(eventAgenda) {
    eventAgenda.preventDefault();
    var idAgenda = eventAgenda.target.id_agenda.value;
    var idEmpresa = eventAgenda.target.id_empresa.value;

    Swal.fire({
      title: 'Você tem certeza que quer deletar esta tarefa?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Confirmar exclusão',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {

        fetch('/action/excluir_agenda.php', {
          method: 'POST',
          headers: {
            "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
          },
          body: 'id_agenda=' + idAgenda + '&id_empresa=' + idEmpresa

        }).then(() => {

          var linhaAgenda = document.getElementById("linhaAgenda" + idEmpresa + '_' + idAgenda);
          var e = linhaAgenda.rowIndex;
          document.getElementById("tabelaAgenda").deleteRow(e);

          Swal.fire({
            position: 'top',
            icon: 'success',
            title: 'Tarefa excluída',
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