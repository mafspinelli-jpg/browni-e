<?php
session_start();

include_once $_SERVER['DOCUMENT_ROOT'] . "/brownie/DAL/usuario.php";

if (isset($_POST['entrar'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $usuarioDAL = new \DAL\Usuario();
    $usuarioLogado = $usuarioDAL->Login($email, $senha);

    if ($usuarioLogado !== null) {
        $_SESSION['usuario'] = $usuarioLogado->getEmail();
        header("Location: index.php");
        exit();
    } else {
        $erro = "E-mail ou senha inválidos no banco de dados!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Browni-e</title>
    <link rel="stylesheet" href="CSS/estilo.css">
</head>

<body>
    <div  class="acesso">
            <div class="menu_acesso">
                <img class="acesso_Logotipo" src="/brownie/IMG/Logotipo.png" alt="Browni-e">
                <img class="acesso_Logo" src="/brownie/IMG/Logo.png" alt="Browni-e">
                <p class="">Sistema de Gestão de Estoque</p>
                <ul>
                    <li>Controle de ingredientes em tempo real</li>
                    <li>Relatórios e gráficos detalhados</li>
                    <li>Gestão de categorias e produtos</li>
                    <li>Alertas de estoque mínimo</li>
                </ul>
            </div>
                

            <div class="acesso_form">
                <form method="POST">
                <h1 class="acesso_title">Bem-vindo de volta</h1>
                <p class="acesso_title">Entre com suas credenciais para acessar o sistema.</p>

                <?php if (isset($erro)) { echo "<p class='error-message'>$erro</p>"; } ?>

                
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email" placeholder="seu@email.com" required>
        
                        <label for="senha">Senha</label>
                        <input type="password" id="senha" name="senha" placeholder="••••••••" required>
                    <button type="submit" name="entrar" class="btn-submit">Entrar</button>

                </form>
            </div>
</div>
</body>
</html>