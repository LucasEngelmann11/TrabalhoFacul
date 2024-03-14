<?php
include("conexao.php");

// Verificar se o formulário de login foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter os valores do formulário
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];

    // Consultar o banco de dados para verificar se o CPF e a senha correspondem a um registro
    $sql = "SELECT * FROM cadastro WHERE cpf = '$cpf' AND senha = '$senha'";
    $result = mysqli_query($conexao, $sql);

    // Verificar se a consulta retornou algum resultado
    if (mysqli_num_rows($result) == 1) {
        // Usuário autenticado com sucesso
        // Redirecionar para a página index.html
        header("Location: index.html");
        exit; // Certifique-se de sair do script após o redirecionamento
    } else {
        // Usuário não encontrado ou senha incorreta
        echo "CPF ou senha incorretos.";
    }
}

mysqli_close($conexao);
?>
