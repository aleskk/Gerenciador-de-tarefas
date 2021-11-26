<?php


//Variáveis para conexão
$host = 'localhost';
$user = 'root';
$pass = '31n8731n';
$dbname = 'organizador';

//Conexão

try {
    $pdo = new PDO("mysql: host=$host; dbname=" . $dbname, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "conexão com banco certinha";
} catch (PDOException $error) {
    echo "Tem algo errado" . $error->getMessage();
}
