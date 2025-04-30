<?php
require 'conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>

<nav class="navbar bg-dark navbar-expand-lg">
  <div class="container-fluid">
    <a style="color:white;" class="navbar-brand" href="index.php">Hospital</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
        </li>
        <li class="nav-item">
            <a class="nav-link" href="sobre.php">Sobre & Contatos</a>
        </li>
        <?php
        if(isset($_SESSION['idUser']) && !empty($_SESSION['idUser'])):
          $nomeUser = $_SESSION['nome'];
          $role = $_SESSION['role'];
          echo"
        <a class=\"nav-link\" href=\"dashboard.php\" style=\"color:white;\">Dashboard</a>"
            ?>
        <?php endif; ?>
      </ul>
      <?php if(isset($_SESSION['idUser']) && !empty($_SESSION['idUser'])):
          $nomeUser = $_SESSION['nome'];
          $role = $_SESSION['role'];
          echo"
      <div class=\"form-inline my-2 my-lg-0\">
        <label style=\"color:white;\" class=\"me-3\">".$nomeUser."</label>
        <a href=\"logout.php\">SAIR</a>
      </div>";
      ?>
      <?php else: echo"<a href=\"login.php\">Faça Login</a>"; endif; ?>
    </div>
  </div>
</nav>

<main>
  <div class="container-fluid">
    <?php
    $pg = "";
    if(isset($_GET['pg']) && !empty($_GET['pg'])){
      $pg = addslashes($_GET['pg']);
    }
    ?>
  </div>
</main>

</body>
</html>

