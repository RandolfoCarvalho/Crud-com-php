<html>
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
include('../includes/conexao.php');
$mysqli = new Conexao();
$mysqli = $mysqli->getConexao();

if (isset($_POST['visitante'])) {
    if (!isset($_SESSION)) {
        session_start();
    }

    // Simula um login de visitante
    $_SESSION['id'] = 0; 
    $_SESSION['nome'] = 'Visitante';
    $_SESSION['tipo'] = 'visitante';

    header("Location: ../includes/index.php");
    exit();
}

if(isset($_POST['email']) || isset($_POST['senha'])) {

    
    if(strlen($_POST['senha']) == 0) {
        echo "<script>mostrarMensagemErro('Preencha sua senha', 'index.php');</script>";
    }
    else if (strlen($_POST['nome']) == 0 && strlen($_POST['email']) == 0 ) {
        echo "<script>mostrarMensagemErro('Preencha seu E-mail/Senha', 'index.php');</script>";
    }
    else {

        $nome = $mysqli->real_escape_string($_POST['nome']); 
        $email = $mysqli->real_escape_string($_POST['email']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM usuarios WHERE (email = '$email' OR nome = '$nome') AND senha = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

        $quantidade = $sql_query->num_rows;

        if($quantidade == 1) {
            
            $usuario = $sql_query->fetch_assoc();

            if(!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['tipo'] = $usuario['tipo'];
            header("Location: ../includes/index.php");

        } else {
            echo "<script>mostrarMensagemErro('Falha ao logar! E-mail ou senha incorretos.', 'index.php');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
      .card-login {
        padding: 30px 0 0 0;
        width: 350px;
        margin: 0 auto;
      }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="#">
            <img src="../public/imagens/logo-crud.png" width="30" height="30" class="d-inline-block align-top" alt="">
            Sistema interno DWSP
        </a>
        </nav>    
    <h1 class="text-center mt-3">Acesse sua conta</h1>
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
                  <input name="nome" type="text" class="form-control" placeholder="User name">
                </div>
                <div class="form-group">
                  <input name="email" type="email" class="form-control" placeholder="E-mail">
                </div>
                <div class="form-group">
                  <input name="senha" type="password" class="form-control" placeholder="Senha">
                </div>

                <button class="btn btn-lg btn-info btn-block" type="submit">Entrar</button>
                <button class="btn btn-lg btn-info btn-block btn-sm" name="visitante" type="submit">Entrar como visitante</button>
                <button class="btn btn-lg btn-info btn-block btn-sm" type="submit" onclick="window.location.href='../registration/registration.php'; return false;">Fazer Cadastro</button>
              
              </form>
            </div>
          </div>
        </div>
    </div>
</body>
</html>