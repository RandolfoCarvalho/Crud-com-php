<?php
include('../auth/protect.php');
require_once 'conexao.php';
class Crud {
    private $conexao;

    public function __construct() {
        $this->conexao = (new Conexao())->getConexao();
    }

    public function criarUsuario($nome, $email, $senha, $data_nasc, $cargo, $ficha) {
        //Prepara a declaração
        $sql = "INSERT INTO cadastro_func (nome, email, senha, data_nasc, cargo, ficha) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("ssssss", $nome, $email, $senha, $data_nasc, $cargo, $ficha);
        $resultado = $stmt->execute();
        $stmt->close();

        return $resultado;
    }
    public function buscarUsuarioPorId($id) {
        $sql = "SELECT * FROM cadastro_func WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }
    public function listarUsuarios() {
        $sql = "SELECT * FROM cadastro_func";
        $result = $this->conexao->query($sql);
        $usuarios = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $usuarios[] = $row;
            }
        }
        return $usuarios;
    }
    public function buscarUsuario($id) {
        $sql = "SELECT * FROM cadastro_func WHERE id = $id";
        $result = $this->conexao->query($sql);

        return $result->fetch_assoc();
    }

    public function atualizarUsuario($id, $nome, $email, $senha, $data_nasc, $cargo) {
        $sql = "UPDATE cadastro_func SET nome = '$nome', email = '$email', senha = '$senha', data_nasc = '$data_nasc', cargo = '$cargo' WHERE id = $id";
        return $this->conexao->query($sql);
    }

    public function deletarUsuario($id) {
        $sql = "DELETE FROM cadastro_func WHERE id = $id";
        return $this->conexao->query($sql);
    }
}
?>
