<?php
session_start();

include("conexao.php");

// Verifica se o usuário está logado
if (!isset($_SESSION['cpf'])) {
    header("Location: login.php");
    exit;
}

// Definindo uma variável para a mensagem de sucesso
$mensagem = '';

// Recupera os dados do usuário do banco de dados
$cpf = $_SESSION['cpf'];
$sql = "SELECT * FROM cadastro WHERE cpf = '$cpf'";
$result = mysqli_query($conexao, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $nome = $row['nome'];
    $sobrenome = $row['sobrenome'];
    $email = $row['email'];
    $dataNascimento = $row['dataNascimento'];
    // O CPF não precisa ser recuperado do banco de dados, pois já está na sessão
} else {
    // Caso ocorra algum erro ao recuperar os dados do usuário, redireciona para uma página de erro ou realiza alguma outra ação
}

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera os dados do formulário
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $dataNascimento = $_POST['dataNascimento'];
    $senha = $_POST['senha'];

    // Verifica se foi fornecida uma nova senha
    if (!empty($senha)) {
        // Se a nova senha não estiver vazia, atualiza os dados na tabela cadastro
        $sql_update = "UPDATE cadastro SET nome = '$nome', sobrenome = '$sobrenome', email = '$email', dataNascimento = '$dataNascimento', senha = '$senha' WHERE cpf = '$cpf'";
    } else {
        // Se a nova senha estiver vazia, atualiza os dados na tabela cadastro sem alterar a senha
        $sql_update = "UPDATE cadastro SET nome = '$nome', sobrenome = '$sobrenome', email = '$email', dataNascimento = '$dataNascimento' WHERE cpf = '$cpf'";
    }

    if (mysqli_query($conexao, $sql_update)) {
        // Define a mensagem de sucesso
        $mensagem = 'Dados atualizados com sucesso';
    } else {
        // Caso ocorra algum erro na atualização, exibe uma mensagem de erro
        echo "Erro ao atualizar os dados: " . mysqli_error($conexao);
    }
}

// Função para deletar o usuário
function deletarUsuario($conexao, $cpf) {
    $sql_delete = "DELETE FROM cadastro WHERE cpf = '$cpf'";
    if (mysqli_query($conexao, $sql_delete)) {
        return true;
    } else {
        return false;
    }
}

// Verifica se a solicitação para deletar o usuário foi enviada
if (isset($_POST['confirmarDeletarConta'])) {
    if (deletarUsuario($conexao, $cpf)) {
        // Redireciona para a página de login após a exclusão
        header("Location: login.php");
        exit;
    } else {
        $mensagem = 'Erro ao deletar a conta';
    }
}

mysqli_close($conexao);
?>


<!DOCTYPE html>
<html lang="pt-br" dir="ltr">

<head>
    <title>Cinefree - Usuário</title>
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
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="css/stylecadastro.css">
   
</head>

<body>

    <!-- início topo -->
      <div class="topo conteudo-flex">

        <div class="topo-esquerdo conteudo-flex">
          <!-- início do logo -->
          <div class="topo-logo">
		  <a href="./index.html">
            <img src="./image/cinefree.png" alt="Imagem logotipo da cinefree" title="Imagem logotipo da cinefree">
			</a>
          </div>
          <!-- fim do logo -->
        </div>

        <!-- início topo centro -->
        <div class="topo-centro conteudo-flex">

          <!-- início menu de navegação -->
          <nav>
            <ul class="topo-menu conteudo-flex">
               <li><a href="index.html">Início</a></li>
              <li><a href="./filmes.html">Filmes</a></li>
              <li><a href="./contato.html">Contato</a></li>
			  <li><a href="./sobrenos.html">Quem Somos</a></li>
            </ul>
          </nav>
          <!-- fim do menu de navegação -->
        </div>
        <!-- fim topo centro -->
		<!-- início topo direito -->
        <div class="topo-direito">
          <!-- área de login -->
          <div class="sublogin">
            <div>
              <button class="subloginbtn">Menu <span class="fa fa-caret-down"></span></button>
            </div>
            <div class="sublogin-conteudo">
				<a href="./login.php">
					<button type="button" title="Login">Logout</button>
				</a>
				<a href="./usuario.php">
					<button type="button" title="Criar Usuario">Usuário</button>
				</a>
			</div>

          </div>
          <!-- fim área de login -->
        </div>
        <!-- fim topo direito -->
    </div>
    <!-- fim do topo -->

    <!-- Conteúdo principal -->
    <div class="conteudo-principal conteudo-flex">
	
        <div class="cadastro-container">
		
            <h2>Dados do usuário</h2>
			
             <!-- Adicionei a div para exibir a mensagem de sucesso -->
            <?php if (!empty($mensagem)): ?>
                <div id="mensagemSucesso" class="mensagem-sucesso"><?php echo $mensagem; ?></div>
            <?php endif; ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form-contato">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="<?php echo $nome; ?>" required>

                <label for="sobrenome">Sobrenome:</label>
                <input type="text" id="sobrenome" name="sobrenome" value="<?php echo $sobrenome; ?>" required>

                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" value="<?php echo $cpf; ?>" required readonly>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>

                <label for="dataNascimento">Data de Nascimento:</label>
                <input type="date" id="dataNascimento" name="dataNascimento" value="<?php echo $dataNascimento; ?>" required>

                <label for="senha">Nova Senha:</label>
                <input type="password" id="senha" name="senha" placeholder="Crie uma nova senha">

                <button type="submit">Atualizar Cadastro</button>
                <button type="button" id="btnDeletarConta">Deletar Conta</button>
            </form>
        </div>
    </div>



   <!-- Modal de confirmação para deletar conta -->
    <div id="modalDeletarConta" class="modal-container">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>Tem certeza de que deseja deletar sua conta?</p>
            <div class="modal-buttons">
                <!-- Adicionamos o atributo "form" para que o botão esteja associado ao formulário -->
                <button class="confirm" form="formDeletarConta" name="confirmarDeletarConta">Confirmar</button>

                <button class="cancel" id="cancelarDeletarConta">Cancelar</button>
            </div>
        </div>
    </div>

    <!-- Formulário oculto para submeter a solicitação de exclusão -->
    <form id="formDeletarConta" method="post">
        <input type="hidden" name="confirmarDeletarConta">
    </form>
	
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

    <script>
        // Função para mostrar o modal ao clicar em "Deletar Conta"
        document.getElementById('btnDeletarConta').addEventListener('click', function() {
            document.getElementById('modalDeletarConta').style.display = 'block';
        });

        // Função para fechar o modal ao clicar no botão "X" ou em "Cancelar"
        document.getElementsByClassName('close')[0].addEventListener('click', function() {
            document.getElementById('modalDeletarConta').style.display = 'none';
        });

        document.getElementById('cancelarDeletarConta').addEventListener('click', function() {
            document.getElementById('modalDeletarConta').style.display = 'none';
        });

        // Função para exibir a mensagem de sucesso ao atualizar o cadastro
        function exibirMensagemSucesso() {
            var mensagemSucessoElemento = document.getElementById('mensagemSucesso');
            if (mensagemSucessoElemento && mensagemSucessoElemento.innerText.trim() !== '') {
                mensagemSucessoElemento.classList.remove('hide');
                // Define um temporizador para ocultar a mensagem após alguns segundos (opcional)
                setTimeout(function() {
                    mensagemSucessoElemento.classList.add('hide');
                }, 2000); // A mensagem será ocultada após 2 segundos
            }
        }

        // Chamamos a função para exibir a mensagem de sucesso se ela estiver definida
        exibirMensagemSucesso();

    </script>
	
	


</body>

</html>
