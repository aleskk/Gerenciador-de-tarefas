<?php
//Url do começo (localhost por enquanto)
include_once 'config.php';
include_once 'tipos_acesso.php';


if (session_id() == "") {
    session_start();}
    
$id_usuario = $_SESSION['login'];

?>

<!DOCTYPE html>
<html lang="pt-BR">
<!-- Cabeçalho html que irá para todas as páginas incluidas-->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/f20c6e805e.js" crossorigin="anonymous"></script>
    <title>Sistema de Gerenciamento de Clientes</title>

    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="<?= $URL_BASE; ?> "title="Empresas"> Empresas <i class="fas fa-industry"></i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= $URL_BASE; ?>/usuarios/usuarios.php" title="Usuários">Usuários <i class="fas fa-user"></i></a>
        </li>

        <?php
        $acessos = $_SESSION['acessos'];

        if (isset($acessos[TipoAcesso::ADM])&& $acessos[TipoAcesso::ADM]) {
            echo "
        <li class=\"nav-item\">
        <a href=\"/area_adm/adm.php\" class=\"nav-link\" title=\"Configuração\"> Configuração <i class=\"fas fa-cog\"></i></a></li>";
        }
        ?>
        <li class="nav-item ms-auto p-2 bd-highlight">
            <a class="btn btn-outline-danger" href="<?= $URL_BASE; ?>/ferramentas/logoff.php" title="Logoff"><i class="fas fa-sign-out-alt"></i></a>
        </li>
    </ul>


<body>

