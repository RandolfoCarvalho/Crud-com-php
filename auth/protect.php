
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function mostrarMensagemErro(mensagem, urlRedirecionamento) {
        Swal.fire({
            icon: 'error',
            title: 'Erro!',
            text: mensagem,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = urlRedirecionamento;
        }
    });;
    }
</script>
</body>
</html>


<?php

if(!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION['id'])) {
    echo "<script>mostrarMensagemErro('Acesso negado! Faça login primeiro.', '../auth/index.php');</script>";
    die();
    }
if (isset($_SESSION['tipo']) && $_SESSION['tipo'] === 'visitante') {
    $paginasPermitidas = ['listar-usuarios.php', 'index.php'];
    $paginaAtual = basename($_SERVER['PHP_SELF']);
    //paginas permitidas
    if (!in_array($paginaAtual, $paginasPermitidas)) {
        echo "<script>mostrarMensagemErro('Acesso negado!', 'index.php');</script>";
        exit();
    }
} elseif (isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'normal') {
    $paginasPermitidas = ['listar-usuarios.php', 'index.php', 'criar.php', 'processo-de-criacao.php'];
    $paginaAtual = basename($_SERVER['PHP_SELF']);
    //paginas permitidas
    if (!in_array($paginaAtual, $paginasPermitidas)) {
        echo "<script>mostrarMensagemErro('Acesso negado!', 'index.php');</script>";
        exit();
      }
    }
    elseif (!isset($_SESSION['tipo'])) {
        header("Location: ../auth/index.php");
        exit();
    }
?>
