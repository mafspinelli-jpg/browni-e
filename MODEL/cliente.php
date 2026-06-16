<?php
namespace MODEL;

class Cliente {
    private ?int $id ;
    private ?string $nome;
    private ?string $cpf;
    private ?string $email;
    private ?string $telefone;
    private ?string $cidade;
    private ?string $estado;

    public function __construct() {}

    public function getId() { 
        return $this->id; 
    }
    public function setId(int $id) { 
        $this->id = $id; 
    }

    public function getNome() { 
        return $this->nome; 
    }
    public function setNome(string $nome) { 
        $this->nome = $nome; 
    }
    public function getCpf() { 
        return $this->cpf; 
    }
    public function setCpf(string $cpf) { 
        $this->cpf = $cpf; 
    }

    public function getEmail() { 
        return $this->email; 
    }
    public function setEmail(string $email) { 
        $this->email = $email; 
    }

    public function getTelefone() { 
        return $this->telefone; 
    }
    public function setTelefone(string $telefone) { 
        $this->telefone = $telefone; 
    }

    public function getCidade() { 
        return $this->cidade; 
    }
    public function setCidade(string $cidade) { 
        $this->cidade = $cidade; 
    }

    public function getEstado() { 
        return $this->estado; 
    }
    public function setEstado(string $estado) { 
        $this->estado = $estado; 
    }

    public function validarCpf($cpf) {
    $cpf = preg_replace('/[^0-9]/', '', $cpf);
     
    if (strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }
    return true;
}

}
?>