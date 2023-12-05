<?php
include('../auth/protect.php');
/* 
$pdfData = $usuario['ficha']; 


header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="documento.pdf"');

ob_clean();
readfile($pdfData); 
*/

use Dompdf\Dompdf;
require '../vendor/autoload.php';

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
var_dump($dados);

if (!empty($dados)) {
    $conteudo_pdf = "<!DOCTYPE html>"; 
    $conteudo_pdf .= "<html lang='pt-br'>"; 
    $conteudo_pdf .= "<head>"; 
    $conteudo_pdf .= "</head>"; 
    $conteudo_pdf .= "<body>"; 
    $conteudo_pdf .= "Nome: " . $dados['nome'] . "<br> <br>";
    $conteudo_pdf .= "Email: " . $dados['email'] ."<br> <br>";
    $conteudo_pdf .= "Senha: " . $dados['senha'] ."<br> <br>";
    $conteudo_pdf .= "Data de Nascimento: " . $dados['data_nasc'] ."<br> <br>";
    $conteudo_pdf .= "Cargo: " . $dados['cargo'] ."<br> <br>";
    $conteudo_pdf .= "</body>";
    $conteudo_pdf .= "</html>";

    echo  $conteudo_pdf;

    $dompdf  = new Dompdf();
    $dompdf->loadHtml($conteudo_pdf);
    $dompdf->setPaper('A4', 'portrait');
    //renderizando
    $dompdf->render();
    //gera
    $dompdf->stream();

} else {
    header('Location: index.php');
}





?>

 