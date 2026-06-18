<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/brownie/DAL/notificacao.php";

$dalNotificacao = new \DAL\Notificacao();

$notificacoes = $dalNotificacao->listar();

?>

<h2>🔔 Notificações</h2>

<hr>

<?php foreach($notificacoes as $n){ ?>

<div style="
padding:15px;
margin-bottom:10px;
border:1px solid #ddd;
border-radius:10px;
background:#fff8f0;
">

<h4><?= $n['titulo']; ?></h4>

<p><?= $n['mensagem']; ?></p>

<small><?= $n['data_criacao']; ?></small>

</div>

<?php } ?>