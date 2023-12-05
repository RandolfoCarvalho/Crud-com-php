<?php
include('../auth/protect.php');
include 'index.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include "../templates/estilo.html";
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Funcionários</title>
</head>
<body>
    <h2  class="text-center mt-3" >Listagem de Funcionários</h2>
    <?php
    require_once 'Crud.php';
    $crud = new Crud();
    $usuarios = $crud->listarUsuarios();
    if (!empty($usuarios)) {
        echo '<ul>';
        foreach ($usuarios as $usuario) {
            echo '<table class="table">';
            echo '<thead class="thead-light">';
            echo '<tr>';
            echo '<th scope="col">ID</th>';
            echo '<th scope="col">Nome</th>';
            echo '<th scope="col">Email</th>';
            echo '<th scope="col">Senha</th>';
            echo '<th scope="col">Data de nascimento</th>';
            echo '<th scope="col">Cargo</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>'; 
            echo "<tr>";
            echo "<td>" . $usuario['id'] . "</td>";
            echo "<td>" . $usuario["nome"] . "</td>";
            echo "<td>" . $usuario["email"] . "</td>";
            echo "<td>" . str_repeat("*", strlen($usuario['senha'])) . "</td>";
            echo "<td>" . $usuario["data_nasc"] . "</td>";
            echo "<td>" . $usuario["cargo"] . "</td>";
            echo '<td><a href="download_ficha.php?id=' . $usuario['id'] . '"><button type="button">Baixar ficha técnica</button></a></td>';

            echo '<td>';
            echo "<td>
            <button  onclick=\"
            location.href='atualizar.php?id=".$usuario['id']."';\" class='btn btn-success'> Editar </button>
            ";
            echo "<button onclick=\"confirmarExclusao(" . $usuario['id'] . ")\" class='btn btn-danger'>Excluir</button>";
            echo "</td>";

            echo "</tr>";
        }
        echo '</ul>';
    } else {
        echo '<p>Nenhum usuário encontrado.</p>';
        echo "<td>
            <button  onclick=\"
            location.href='index.php" . "';\" class='btn btn-success'> Voltar ao inicio </button>";
            echo "<td>
            <button  onclick=\"
            location.href='criar.php" . "';\" class='btn btn-success'> Adicionar usuario </button>";
    }
    ?>
    <script>
        function confirmarExclusao(id) {
            if (confirm('Tem certeza que deseja excluir?')) {
                window.location.href = 'delete.php?id=' + id;
            } else {
                return false;
            }
        }
    </script>

</body>
</html>
