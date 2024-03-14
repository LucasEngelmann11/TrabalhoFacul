<?php
    include ("conexao.php");
    
    $nome=$_POST['nome'];
    $sobrenome=$_POST['sobrenome'];
    $cpf=$_POST['cpf'];
    $email=$_POST['email'];
    $dataNascimento = date('Y-m-d', strtotime($_POST['dataNascimento']));
    $senha=$_POST['senha'];

    $sql = "INSERT INTO cadastro (nome, sobrenome, cpf, email, dataNascimento, senha) VALUES ('$nome', '$sobrenome', '$cpf', '$email', '$dataNascimento','$senha')";
    
    if (mysqli_query($conexao, $sql)){
        echo "Usuario cadastrado com sucesso";

    }
    else{
        echo "Erro".mysqli_connect_error($conexao);
    }
    mysqli_close($conexao);
?>