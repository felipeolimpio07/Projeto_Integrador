<?php
require 'conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .navbar {
            background-color: #343a40;
            padding: 10px 20px;
            color: white;
            font-size: 18px;
            text-align: center;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        main {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding-top: 70px; /* Ajusta o padding top para que o conteúdo não fique por baixo da barra */
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }

        h2 {
            text-align: center;
            color: #4CAF50;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: #0056b3;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-group button:hover {
            background-color: #004494;
        }

        .motivation {
            margin-top: 30px;
            text-align: left;
        }

        .motivation h3 {
            color: #4CAF50;
            margin-bottom: 15px;
        }

        .motivation p {
            margin-bottom: 10px;
            font-size: 16px;
            line-height: 1.6;
        }

        .highlight {
            font-weight: bold;
            color: #d9534f;
        }
    </style>
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
    <div class="container">
        <h2>Gerenciamento de Consultas</h2>
        <div class="form-group">
            <button class="btn btn-primary" onclick="window.location.href='agendar_consulta.php'">Agendar Consultas</button>
        </div>
        <div class="form-group">
            <button class="btn btn-primary" onclick="window.location.href='consultas_agendadas.php'">Ver Consultas</button>
        </div>
        <div class="motivation">
            <h3>Por que Doar Sangue?</h3>
            <p><span class="highlight">Salvar Vidas:</span> Uma única doação de sangue pode salvar até três vidas. Doar sangue é um ato simples que pode fazer uma diferença significativa para pacientes em necessidade.</p>
            <p><span class="highlight">Benefícios para a Saúde:</span> Doar sangue pode melhorar a saúde cardiovascular do doador e reduzir o risco de certos tipos de câncer.</p>
            <p><span class="highlight">Solidariedade:</span> Ao doar sangue, você demonstra um gesto de solidariedade e compaixão com a comunidade, ajudando a manter os estoques de sangue sempre disponíveis.</p>
            <p><span class="highlight">Monitoramento de Saúde:</span> Doadores de sangue recebem um mini-check-up gratuito a cada doação, o que pode ajudar a detectar potenciais problemas de saúde antes que se tornem graves.</p>
            <p><span class="highlight">Impacto Comunitário:</span> A doação regular de sangue ajuda a garantir que os hospitais tenham suprimentos suficientes para emergências, cirurgias e tratamentos crônicos.</p>
        </div>
    </div>
</main>

</body>
</html>
