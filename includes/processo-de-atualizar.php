<?php
include('../auth/protect.php');

?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'crud.php';

    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha =  md5($_POST['senha']);
    $data_nasc = $_POST['data_nasc'];
    $cargo = $_POST['cargo'];

    $crud = new Crud();
    $crud->atualizarUsuario($id, $nome, $email, $senha, $data_nasc, $cargo);

    header('Location: listar-usuarios.php');
    exit();
}
?>
