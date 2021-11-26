<?php
include_once __DIR__ . '/../ferramentas/conexao.php';
include_once __DIR__ . '/tipos_acesso.php';


$sql = $pdo->prepare("SELECT id_acessos FROM acesso where id_usuario = :id_usuario");
$sql->bindValue(':id_usuario', $id_usuario);
$sql->execute();
$acessos_usuario = $sql->fetchAll(PDO::FETCH_COLUMN);

// Criando o array acessos,  pois vão ter várias informações

$acessos = [];

// Vendo quais acessos o usuário tem

$acessos[TipoAcesso::VISUALIZAR_EMPRESA] =  in_array(TipoAcesso::VISUALIZAR_EMPRESA, $acessos_usuario);
$acessos[TipoAcesso::INCLUIR_EMPRESA] =  in_array(TipoAcesso::INCLUIR_EMPRESA, $acessos_usuario);
$acessos[TipoAcesso::EDITAR_EMPRESA] =  in_array(TipoAcesso::EDITAR_EMPRESA, $acessos_usuario);
$acessos[TipoAcesso::EXCLUIR_EMPRESA] =  in_array(TipoAcesso::EXCLUIR_EMPRESA, $acessos_usuario);
$acessos[TipoAcesso::VISUALIZAR_CONTATOS] =  in_array(TipoAcesso::VISUALIZAR_CONTATOS, $acessos_usuario);
$acessos[TipoAcesso::INCLUIR_CONTATOS] =  in_array(TipoAcesso::INCLUIR_CONTATOS, $acessos_usuario);
$acessos[TipoAcesso::EDITAR_CONTATOS] =  in_array(TipoAcesso::EDITAR_CONTATOS, $acessos_usuario);
$acessos[TipoAcesso::EXCLUIR_CONTATOS] =  in_array(TipoAcesso::EXCLUIR_CONTATOS, $acessos_usuario);
$acessos[TipoAcesso::VISUALIZAR_USUARIOS] =  in_array(TipoAcesso::VISUALIZAR_USUARIOS, $acessos_usuario);
$acessos[TipoAcesso::INCLUIR_USUARIOS] =  in_array(TipoAcesso::INCLUIR_USUARIOS, $acessos_usuario);
$acessos[TipoAcesso::EDITAR_USUARIOS] =  in_array(TipoAcesso::EDITAR_USUARIOS, $acessos_usuario);
$acessos[TipoAcesso::EXCLUIR_USUARIOS] =  in_array(TipoAcesso::EXCLUIR_USUARIOS, $acessos_usuario);
$acessos[TipoAcesso::VISUALIZAR_AGENDA] =  in_array(TipoAcesso::VISUALIZAR_AGENDA, $acessos_usuario);
$acessos[TipoAcesso::INCLUIR_AGENDA] =  in_array(TipoAcesso::INCLUIR_AGENDA, $acessos_usuario);
$acessos[TipoAcesso::EDITAR_AGENDA] =  in_array(TipoAcesso::EDITAR_AGENDA, $acessos_usuario);
$acessos[TipoAcesso::EXCLUIR_AGENDA] =  in_array(TipoAcesso::EXCLUIR_AGENDA, $acessos_usuario);
$acessos[TipoAcesso::ADM] =  in_array(TipoAcesso::ADM, $acessos_usuario);

// Criando a sessão para que eu possa usar em outras páginas como validação de acesso

$_SESSION['acessos'] = $acessos;

