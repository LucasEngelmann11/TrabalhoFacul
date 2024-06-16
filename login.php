<!DOCTYPE html>
<html lang="en">
<head>
    	
	<title>Cinefree Cinemas</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="./image/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./image/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./image/favicons/favicon-16x16.png">
    <link rel="manifest" href="./image/favicons/site.webmanifest">
    <link rel="mask-icon" href="./image/favicons/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/stylecadastro.css">
	<link rel="stylesheet" href="css/stylelogin.css">
    <title>Tela de Login</title>
</head>
<body>

<!-- início topo -->
<div class="topo conteudo-flex">

    <div class="topo-esquerdo conteudo-flex">
        <!-- início do logo -->
        <div class="topo-logo">
                <img src="./image/cinefree.png" alt="Imagem logotipo da cinefree" title="Imagem logotipo da cinefree">        
        </div>
        <!-- fim do logo -->
    </div>    

</div>
<!-- fim do topo -->

<div class="login-container">
    <h2>Login</h2>
   <?php
// Iniciar a sessão
session_start();

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
        // Salvar o CPF na sessão
        $_SESSION['cpf'] = $cpf;
        
        // Redirecionar para a página index.html
        header("Location: index.html");
        exit; // Certifique-se de sair do script após o redirecionamento
    } else {
        // Usuário não encontrado ou senha incorreta
        $_SESSION['mensagem_erro'] = "CPF ou senha incorretos.";
        header("Location: login.php"); // Redireciona de volta para a página de login
        exit;
    }
}

mysqli_close($conexao);
?>
    <form action="login.php" method="post">
        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" required>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>

        <input type="submit" value="Login">
    </form>

    <!-- Botão de cadastro -->
    <form action="./cadastro.html" method="get">
        <input type="submit" value="Cadastrar">
    </form>
</div>

<!-- Exibição da mensagem de erro -->
<?php if (isset($_SESSION['mensagem_erro'])) : ?>
<div id="mensagem-erro" class="mensagem-erro"><?php echo $_SESSION['mensagem_erro']; ?></div>
<?php unset($_SESSION['mensagem_erro']); endif; ?>

<script>
    // Exibe a mensagem de erro
    document.addEventListener('DOMContentLoaded', function() {
        var mensagemErro = document.getElementById('mensagem-erro');
        if (mensagemErro) {
            mensagemErro.style.display = 'block'; // Exibe a mensagem
            setTimeout(function() {
                mensagemErro.style.display = 'none'; // Esconde a mensagem após 2 segundos
            }, 2000); // Tempo em milissegundos (2 segundos)
        }
    });
</script>

<!-- início rodape -->
    <footer>
      <div class="site-map conteudo-flex">
        <div class="site-map-conteudo">
          <ul>
            <li><a href="#">Sobre nós</a></li>
          </ul>
        </div>
        <div class="site-map-conteudo">
          <ul>
            <li><a href="#">Termo de Uso</a></li>
          </ul>
        </div>
        <div class="site-map-conteudo">
          <ul>
            <li><a href="./html/contato.html">Contato</a></li>
          </ul>
        </div>
      </div>
	  
	  <div>
        <img src="./image/cinefree.png" alt="Imagem logotipo da cienfree" title="Imagem logotipo da cinefree">
      </div>
    
    </footer>
    <!-- fim rodape -->

</body>
</html>
