<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "vittor";
$port = 3306;


try{
    $conn = new PDO("mysql:host=$host;port=$port;dbname=" . $dbname, $user, $pass);
    
    //echo "Conexão com banco de dados realizada com sucesso";
} catch(PDOException $err){
    echo "Erro #1135 " . $err->getMessage();
} 