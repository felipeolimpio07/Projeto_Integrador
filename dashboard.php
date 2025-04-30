<?php
session_start();
include("barra.php"); // Inclui o barra.php no início da página
include ("verifica.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body style="background-color: #f4f4f4;">
<?php
        if(isset($_SESSION['idUser']) && !empty($_SESSION['idUser'])):
          $nomeUser = $_SESSION['nome'];
          $role = $_SESSION['role'];
          echo"<div class=\"container\" style=\"padding-top:20px;\"><h1>Seja Bem-vindo ".$nomeUser."</h1>"
            ?><?php
            if($role == 'admin')echo"<div class=\"container\" style=\"padding-top:10px;\">
            <a class=\"btn btn-dark dashbtn\" href=\"cad_usuario.php\" style=\"font-size:30px; padding-top:10px;\">Cadastrar Usuário</a><br/>
            <a class=\"btn btn-dark dashbtn\" href=\"consultas_agendadas.php\" style=\"font-size:30px; padding-top:10px;\">Consultas Agendadas</a><br/>
            <a class=\"btn btn-dark dashbtn\" href=\"formulario_para_locais.php\" style=\"font-size:30px; padding-top:10px;\">Cadastrar Local de Doação</a><br/>
            <a class=\"btn btn-dark dashbtn\" href=\"locais.php\" style=\"font-size:30px; padding-top:10px;\">Locais para Doação</a><br/></div>";
            else echo"<div class=\"container\"><a class=\"btn btn-dark dashbtn\" href=\"locais.php\" style=\"font-size:30px; padding-top:10px;\">Agendar consulta</a></div>";
            endif;
            ?>  
          </ul>
        </li>
</body>
</html>

