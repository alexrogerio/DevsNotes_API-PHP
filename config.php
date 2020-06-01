<?php
$db_host = 'localhost';
$db_name = 'devsnotes';
$db_user = 'root';
$db_pass = '';

try{
    $pdo = new PDO("mysql:dbname=$db_name;host=$db_host",$db_user, $db_pass);
    
    $array = [
        'error' => '',
        'result' => []
    ];
}catch(PDOException $e){
    echo "Erro: ".$e->getMessage();
}