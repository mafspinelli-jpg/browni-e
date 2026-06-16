<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}

include_once $_SERVER['DOCUMENT_ROOT'] . "/brownie/MODEL/cliente.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/brownie/DAL/cliente.php";

$clienteDAL = new \DAL\Cliente();

if (!isset($_GET['id'])) {
    header("Location: clientes.php");
    exit();
}

$id = intval($_GET['id']);
$clienteAtual = $clienteDAL->SelectById($id);

if ($clienteAtual == null) {
    echo "Cliente não encontrado!";
    exit();
}

if (isset($_POST['editar'])) {
    $clienteAtual->setNome($_POST['nome']);
    $clienteAtual->setCpf($_POST['cpf']);
    $clienteAtual->setEmail($_POST['email']);
    $clienteAtual->setTelefone($_POST['telefone']);
    $clienteAtual->setCidade($_POST['cidade']);
    $clienteAtual->setEstado($_POST['estado']);

    $resultado = $clienteDAL->Update($clienteAtual);

    if ($resultado) {
        header("Location: clientes.php");
        exit();
    } else {
        echo "<p style='color: red;'>Erro ao atualizar o cliente.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente - Browni-e</title>
    <link rel="stylesheet" href="../CSS/estilo.css">
</head>
<body>
<div class="menu_lateral">
    <img class="Logo" src="/brownie/IMG/Logo.png" alt="Logo">
    <a href="clientes.php">Cancelar e voltar</a>
    <a href="../logout.php"><b> SAIR DO SISTEMA </b></a>
</div>

<div class="escopo">
    <h1>Editar Cadastro do Cliente</h1>

    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $clienteAtual->getId(); ?>">
        Nome: <br> 
        <input type="text" name="nome" value="<?php echo $clienteAtual->getNome(); ?>" required> <br><br>
        Cpf: <br> 
        <input type="text" name="cpf" value="<?php echo $clienteAtual->getCpf(); ?>" required> <br><br>
        E-mail: <br> 
        <input type="email" name="email" value="<?php echo $clienteAtual->getEmail(); ?>" required> <br><br>
        Telefone: <br> 
        <input type="text" name="telefone" value="<?php echo $clienteAtual->getTelefone(); ?>" required> <br><br>
        Cidade: <br> 
        <input type="text" name="cidade" value="<?php echo $clienteAtual->getCidade(); ?>" required> <br><br>
        Estado: <br> 
        <input type="text" name="estado" maxlength="2" value="<?php echo $clienteAtual->getEstado(); ?>" required> <br><br>
        <button name="editar">Salvar Alterações</button>
    </form>
    
</div>
</body>
</html>