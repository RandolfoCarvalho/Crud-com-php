<?php
include('../auth/protect.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Usuário</title>
    <style>
    .centro-horizontal {
        margin-left: auto;
        margin-right: auto;
    }
   

</style>

</head>
<body>
    
    <?php
    include 'index.php';
    require_once 'crud.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $crud = new Crud();
        $usuario = $crud->buscarUsuario($id);

        if ($usuario) {
            ?>
            <h2 class="text-center mt-3"  >Atualizar Usuário</h2>
            <div class="container">    
        <div class="row">
        
        <div class="card-login">
          <div class="card">
            <div class="card-header">
              Atualizar dados
            </div>
          
            <div class="card-body">
              <form action="processo-de-atualizar.php" method="post">
                <div class="form-group">
                 <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
                </div>
                <div class="form-group">
                Nome: <input type="text" name="nome" value="<?php echo $usuario['nome']; ?>" required><br>
                </div>
                <div class="form-group">
                Email: <input type="email" name="email" value="<?php echo $usuario['email']; ?>" required><br>
                </div>
                <div class="form-group">
                Senha: <input type="password" name="senha" value="<?php echo $usuario['email']; ?>" required><br>
                </div>
                <div class="form-group">
                Data de nascimento: <input type="date" name="data_nasc" value="<?php echo $usuario['data_nasc']; ?>" required><br>
                </div>
                <div class="form-group">
                Cargo: <input type="text" name="cargo" value="<?php echo $usuario['cargo']; ?>" required><br>
                </div>

                <button class="btn btn-lg btn-info btn-block" type="submit">Atualizar</button>
                <button class="btn btn-lg btn-info btn-block btn-sm" type="submit" onclick="window.location.href='listar-usuarios.php'; return false;">Voltar</button>
              </form>
            </div>
        </div>
          </div>
        </div>
    </div>
            <?php
        } else {
            echo '<p>Usuário não encontrado.</p>';
        }
    } else {
        echo '<p>ID de usuário não fornecido.</p>';
    }
    ?>
</body>
</html>



