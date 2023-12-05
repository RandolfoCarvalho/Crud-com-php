<?php
include('../auth/protect.php');

if (isset($_GET['id'])) {

    $id = $_GET['id'];
    require_once 'Crud.php';
    $crud = new Crud();
    $crud->deletarUsuario($id);

    header('Location: listar-usuarios.php');
    exit();
} else {
    echo '<p>ID de usuário não fornecido.</p>';
}
?>
