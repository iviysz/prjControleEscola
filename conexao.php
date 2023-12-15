<?php

$usuario = 'root';
$senha = 'mamae100.';
$database = 'login';
$host = 'localhost:3307';

$conexao = mysqli_connect($host, $usuario, $senha, $database) or die('Não foi possível conectar');

$mysqli = new mysqli($host, $usuario, $senha, $database);

if ($mysqli->error) {
    die("Falha ao conectar ao banco de dados: " . $mysqli->error);
}

?>