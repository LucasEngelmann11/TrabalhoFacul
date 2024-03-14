<?php
    $dbHost = 'Localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'db_cine';

    $conexao=mysqli_connect($dbHost,$dbUsername,$dbPassword,$dbName);
    if (!$conexao){
        die("Houve um erro:".mysqli_connect_errno());
    }


?>