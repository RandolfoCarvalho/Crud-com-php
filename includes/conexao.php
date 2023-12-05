<?php
class Conexao {
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $base = "cadastro";

    private $conexao;

    public function __construct()
    {
        $this->conexao = new mysqli($this->host, $this->user, $this->password, $this->base);

        if($this->conexao->connect_error) {
            die("Erro na conexão: " . $this->conexao->connect_error);
        }
    }
    public function getConexao() {
        return $this->conexao;
    }
}
 


?>