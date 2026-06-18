<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}

include_once $_SERVER['DOCUMENT_ROOT'] . "/brownie/MODEL/categoria.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/brownie/DAL/categoria.php";

$categoriaDAL = new \DAL\Categoria();

// LÓGICA DE EXCLUIR
if (isset($_GET['excluir_id'])) {
    $idExcluir = intval($_GET['excluir_id']);
    $resultadoDel = $categoriaDAL->Delete($idExcluir);

    if ($resultadoDel) {
        header("Location: categorias.php");
        exit();
    } else {
        echo "<div class='alerta alerta-erro'><b>Erro:</b> Falha ao excluir a categoria.</div>";
    }
}

// LÓGICA DE CADASTRAR
if (isset($_POST['cadastrar'])) {
    $categoria = new \MODEL\Categoria();
    $categoria->setNome($_POST['nome']);

    $resultado = $categoriaDAL->Insert($categoria);

    if ($resultado) {
        header("Location: categorias.php");
        exit();
    } else {
        echo "<div class='alerta alerta-erro'><b>Erro:</b> Falha ao cadastrar a categoria</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Categorias - Browni-e</title>
    <link rel="stylesheet" href="../CSS/estilo.css">
</head>
<body>
 <div class="menu_lateral">
    <img class="Logo" src="/brownie/IMG/Logo.png" alt="Logo">
    <a href="../index.php">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
        <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5"/>
        </svg>
            Home</a>
        <a href="../VIEW/clientes.php">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
        <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
        </svg>
            Clientes</a>
        <a href="../VIEW/categorias.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tag-fill" viewBox="0 0 16 16">
            <path d="M2 1a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l4.586-4.586a1 1 0 0 0 0-1.414l-7-7A1 1 0 0 0 6.586 1zm4 3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
            </svg>
            Categorias</a>
        <a href="../VIEW/produtos.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cake2" viewBox="0 0 16 16">
            <path d="m3.494.013-.595.79A.747.747 0 0 0 3 1.814v2.683q-.224.051-.432.107c-.702.187-1.305.418-1.745.696C.408 5.56 0 5.954 0 6.5v7c0 .546.408.94.823 1.201.44.278 1.043.51 1.745.696C3.978 15.773 5.898 16 8 16s4.022-.227 5.432-.603c.701-.187 1.305-.418 1.745-.696.415-.261.823-.655.823-1.201v-7c0-.546-.408-.94-.823-1.201-.44-.278-1.043-.51-1.745-.696A12 12 0 0 0 13 4.496v-2.69a.747.747 0 0 0 .092-1.004l-.598-.79-.595.792A.747.747 0 0 0 12 1.813V4.3a22 22 0 0 0-2-.23V1.806a.747.747 0 0 0 .092-1.004l-.598-.79-.595.792A.747.747 0 0 0 9 1.813v2.204a29 29 0 0 0-2 0V1.806A.747.747 0 0 0 7.092.802l-.598-.79-.595.792A.747.747 0 0 0 6 1.813V4.07c-.71.05-1.383.129-2 .23V1.806A.747.747 0 0 0 4.092.802zm-.668 5.556L3 5.524v.967q.468.111 1 .201V5.315a21 21 0 0 1 2-.242v1.855q.488.036 1 .054V5.018a28 28 0 0 1 2 0v1.964q.512-.018 1-.054V5.073c.72.054 1.393.137 2 .242v1.377q.532-.09 1-.201v-.967l.175.045c.655.175 1.15.374 1.469.575.344.217.356.35.356.356s-.012.139-.356.356c-.319.2-.814.4-1.47.575C11.87 7.78 10.041 8 8 8c-2.04 0-3.87-.221-5.174-.569-.656-.175-1.151-.374-1.47-.575C1.012 6.639 1 6.506 1 6.5s.012-.139.356-.356c.319-.2.814-.4 1.47-.575M15 7.806v1.027l-.68.907a.94.94 0 0 1-1.17.276 1.94 1.94 0 0 0-2.236.363l-.348.348a1 1 0 0 1-1.307.092l-.06-.044a2 2 0 0 0-2.399 0l-.06.044a1 1 0 0 1-1.306-.092l-.35-.35a1.935 1.935 0 0 0-2.233-.362.935.935 0 0 1-1.168-.277L1 8.82V7.806c.42.232.956.428 1.568.591C3.978 8.773 5.898 9 8 9s4.022-.227 5.432-.603c.612-.163 1.149-.36 1.568-.591m0 2.679V13.5c0 .006-.012.139-.356.355-.319.202-.814.401-1.47.576C11.87 14.78 10.041 15 8 15c-2.04 0-3.87-.221-5.174-.569-.656-.175-1.151-.374-1.47-.575-.344-.217-.356-.35-.356-.356v-3.02a1.935 1.935 0 0 0 2.298.43.935.935 0 0 1 1.08.175l.348.349a2 2 0 0 0 2.615.185l.059-.044a1 1 0 0 1 1.2 0l.06.044a2 2 0 0 0 2.613-.185l.348-.348a.94.94 0 0 1 1.082-.175c.781.39 1.718.208 2.297-.426"/>
            </svg>
            Produtos</a>
        <a href="../VIEW/pedidos.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
            <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0M7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0"/>
            </svg>
            Pedidos</a>
  
    <a href="../logout.php"><b> 
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z"/>
        <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z"/>
        </svg>
        SAIR DO SISTEMA </b></a>
</div>

<div class="escopo">
    <h1>Gerenciar Categorias de Doces</h1>

    <h2>Cadastrar Nova Categoria</h2>
    <form method="POST">
        Nome da Categoria: <br>
        <input type="text" name="nome" placeholder="Ex: Brownies, Bolos, Brigadeiros" required> <br><br>
        <button name="cadastrar">Salvar Categoria</button>
    </form>

    <hr>

    <h3>Categorias Cadastradas</h3>
    <input class="input_filto" type="text" id="buscarCatego" placeholder="Digite o nome da categoria...">
    <?php
    $listaDeCategorias = $categoriaDAL->Select();

    if (!empty($listaDeCategorias)) {
        echo "<table id='tabelaCatego'>";
        echo "<tr>
                <th>ID</th>
                <th>Nome da Categoria</th>
                <th>Ações</th>
              </tr>";

        foreach ($listaDeCategorias as $cat) {
            echo "<tr>";
            echo "<td>" . $cat->getId() . "</td>";
            echo "<td class='nome-catego'>" . $cat->getNome() . "</td>";
            echo "<td>
                    <a href='editar_categoria.php?id=" . $cat->getId() . "' style='color: blue;'><img src='/brownie/IMG/pencil.svg' style='width: 20px; height: 20px; vertical-align: middle;'>
                    </a> 
                    | 
                    <a href='categorias.php?excluir_id=" . $cat->getId() . "' onclick=\"return confirm('Tem certeza que deseja excluir esta categoria?')\" style='color: red;'> <img src='/brownie/IMG/lixeira.svg'  style='width: 20px; height: 20px; vertical-align: middle;'></a>
                  </td>";
                  
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Nenhuma categoria cadastrada ainda.</p>";
    }
    ?>
    
</div>

<script>
document.getElementById('buscarCatego').addEventListener('keyup', function() {
    var busca = this.value.toLowerCase();
    var tabela = document.getElementById('tabelaCatego');
    if (!tabela) return;
    var linhas = tabela.getElementsByTagName('tr');
    for (var i = 1; i < linhas.length; i++) {
        var celulaNome = linhas[i].querySelector('.nome-catego');
        if (celulaNome) {
            var nomeCatego = celulaNome.textContent.toLowerCase();
            if (nomeCatego.indexOf(busca) > -1) {
                linhas[i].style.display = ''; 
            } else {
                linhas[i].style.display = 'none'; 
            }
        }
    }
});
</script>
</body>
</html>