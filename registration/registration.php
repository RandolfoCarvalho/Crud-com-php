<?php
include('../includes/conexao.php');
$conexao = new Conexao();
$conexao = $conexao->getConexao();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <style>
      .card-login {
        padding: 30px 0 0 0;
        width: 350px;
        margin: 0 auto;
      }
    </style>
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function mostrarMensagemErro(mensagem) {
        Swal.fire({
            icon: 'error',
            title: 'Erro!',
            text: mensagem,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    }
</script>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($conexao->connect_error) {
            die("Falha na conexão: " . $conexao->connect_error);
        }
        $nome = $conexao->real_escape_string($_POST["nome"]);
        $email = $conexao->real_escape_string($_POST["email"]);
        $senha = $conexao->real_escape_string($_POST["senha"]);

        //meus tipos de usuario
        $tipo = $conexao->real_escape_string($_POST["tipo"]);
        $verificaExistenciaEmail = "SELECT * FROM usuarios WHERE email = '$email'";
        $queryExistencia = $conexao->query($verificaExistenciaEmail);
        $sql = "INSERT INTO usuarios (nome, email, senha, tipo) VALUES ('$nome', '$email', '$senha', '$tipo')";

        if ($queryExistencia->num_rows > 0) {
            echo "<script>mostrarMensagemErro('Erro! E-mail já existe.');</script>";
        }
        else if (strlen($senha) < 4) {
            echo "<script>mostrarMensagemErro('Senha muito curta');</script>";
        }
        else if ($tipo === 'admin' && !terminaCom($email, '@admin.com')) { 
            echo "<script>mostrarMensagemErro('Falha ao logar! E-mail precisa terminar com @admin.com');</script>";
        }
        elseif ($conexao->query($sql) === TRUE) {

            if(!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['tipo'] = $tipo;
            echo "Cadastro realizado com sucesso!";
            header('Location: ../auth/index.php');
        } else {
            echo "Erro ao cadastrar: " . $conexao->error;
        }
        $conexao->close();
    }

    function terminaCom($agulha, $palheiro) {
        $comprimento = strlen($palheiro);
        if ($comprimento == 0) {
            return true;
        }
        return (substr($agulha, -$comprimento) === $palheiro);
    }
    ?>
     <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="../auth/index.php">
            <img src="../public/imagens/logo-crud.png" width="30" height="30" class="d-inline-block align-top" alt="">
            Sistema interno DWSP
        </a>
        </nav>    
    <h1 class="text-center mt-3">Cadastro</h1>
    <div class="container">    
      <div class="row">

        <div class="card-login">
          <div class="card">
            <div class="card-header">
              Login
            </div>
            <div class="card-body">
              <form action="" method="post">
                <div class="form-group">
                  <input name="nome" type="text" class="form-control" placeholder="User name" required>
                </div>
                <div class="form-group">
                  <input name="email" type="email" class="form-control" placeholder="E-mail" required>
                </div>
                <div class="form-group">
                  <input name="senha" type="password" class="form-control" placeholder="Senha" required>
                </div>
                <label for="">Tipo de conta</label>
                <select class="form-control" name="tipo" required>
                <option value="normal">Normal</option>
                <option value="admin">Admin</option>
                </select>
                <br> 
                <button class="btn btn-lg btn-info btn-block" type="submit">Cadastrar</button>
                <button class="btn btn-lg btn-info btn-block btn-sm" type="submit" onclick="window.location.href='../auth/index.php'; return false;">Fazer Login</button>
              
              </form>
            </div>
          </div>
        </div>
    </div>
  
</body>
</html>
