<?php
include('../auth/protect.php');
?>

<?php

//precisa criar o campo ficha novamente
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'Crud.php';
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = md5($_POST['senha']);
    $data_nasc = $_POST['data_nasc'];
    $cargo = $_POST['cargo'];
    $ficha = $_POST['ficha'];
    $crud = new Crud();
    $crud->criarUsuario($nome, $email, $senha, $data_nasc, $cargo, $ficha);
    


    header('Location: listar-usuarios.php');
}
?>
