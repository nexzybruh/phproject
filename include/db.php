<?php
$host = '127.0.0.1';
$user = 'root';       // Substitua pelo seu usuário do MySQL
$password = '';     // Substitua pela sua senha do MySQL
$dbname = 'sync';            // Nome do banco de dados

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die('Conexão falhou: ' . mysqli_connect_error());
}
?>
