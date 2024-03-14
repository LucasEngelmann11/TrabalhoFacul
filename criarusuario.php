<?php
    include ("conexao.php");
    
    $Usuario=$_POST['usuario'];
    $Telefone=$_POST['telefone'];
    $Email=$_POST['email'];
    $Senha=$_POST['senha'];
	$Confirmar_Senha=$_POST['confirmar_senha'];

    $sql = "INSERT INTO Cadastro_Usuario (usuario, telefone, email, senha, confirmar_senha) VALUES ('$Usuario', '$Email', '$Telefone', '$Senha', '$Confirmar_Senha')";
    
    if (mysqli_query($conexao, $sql)){
        echo "Usuario cadastrado com sucesso";

    }
    else{
        echo "Erro".mysqli_connect_error($conexao);
    }
    mysqli_close($conexao);
?>