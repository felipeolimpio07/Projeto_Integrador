<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Seu código de conexão com o banco de dados continua aqui...

$localhost = "localhost";
$user = "root";
$passw = "";
$banco = "hospital";

global $pdo;

try{
    $pdo = new PDO("mysql:dbname=".$banco."; host=".$localhost, $user, $passw);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo "ERRO: ".$e->getMessage();
    exit;
}
?>
