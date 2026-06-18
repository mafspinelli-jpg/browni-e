<?php

namespace MODEL;

class Notificacao {

    private ?int $id = null;
    private ?string $titulo = null;
    private ?string $mensagem = null;
    private ?string $data_criacao = null;
    private ?int $lida = 0;

    public function getTitulo(){
        return $this->titulo;
    }

    public function setTitulo($titulo){
        $this->titulo = $titulo;
    }

    public function getMensagem(){
        return $this->mensagem;
    }

    public function setMensagem($mensagem){
        $this->mensagem = $mensagem;
    }
}