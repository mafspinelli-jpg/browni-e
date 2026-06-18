<?php

namespace DAL;

include_once $_SERVER['DOCUMENT_ROOT'] . "/brownie/DAL/conexao.php";

class Notificacao {

    public function cadastrar($titulo, $mensagem){

        $con = Conexao::conectar();

        $sql = "INSERT INTO notificacoes
                (titulo, mensagem)
                VALUES (?, ?)";

        $query = $con->prepare($sql);

        $resultado = $query->execute([
            $titulo,
            $mensagem
        ]);

        Conexao::desconectar();

        return $resultado;
    }

    public function listar(){

        $con = Conexao::conectar();

        $sql = "SELECT *
                FROM notificacoes
                ORDER BY data_criacao DESC";

        $query = $con->query($sql);

        $resultado = $query->fetchAll(\PDO::FETCH_ASSOC);

        Conexao::desconectar();

        return $resultado;
    }
}