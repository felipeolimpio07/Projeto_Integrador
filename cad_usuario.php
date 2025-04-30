<?php
include ("barra.php")
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
    <style>
        .message {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1.2em;
            text-align: center;
            z-index: 1000;
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            display: none;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }
        .message.show {
            display: block;
            opacity: 1;
        }
        .form-container {
            width: 300px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 100px; /* Adiciona uma margem superior para descer o formulário */
        }
        .form-container input, .form-container select {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
        }
        .form-container select {
            border: 2px solid black; /* Adiciona a borda preta */
        }
        .form-container button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        html, body {
            height: 100%;
            margin: 0;
        }
        .form-container {
            width: 200px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 20px; /* Ajuste para descer o formulário */
        }
    </style>
</head>
<body style="background-color: #f4f4f4;">

<main>
    <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
        <div id="message" class="message show">Conta criada com <strong>sucesso!</strong></div>
    <?php endif; ?>
    <form class="form" action="cad_usuario.php" method="POST">
        <div class="card">
            <div class="card-top">
                <h2 class="title">Cadastro de Usuário</h2>
            </div><br/>
            <div class="card-group">
                <label for="nome">Nome de Usuário:</label>
                <input type="text" id="nome" name="nome" class="form-control" placeholder="Digite seu nome" required value=""><br>
            </div>
            <div class="card-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Digite seu email" required value=""><br>
            </div>
            <div class="card-group">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" class="form-control" placeholder="Digite sua senha" required value=""><br>
            </div>
            <div class="card-group">
                <label for="role">Função:</label>
                <select id="role" name="role" class="form-select" required>
                    <option value="">Selecione...</option> <!-- Caixa de texto em branco -->
                    <option value="admin">Admin</option>
                    <option value="user">Usuário Comum</option>
                </select><br>
            </div>
            <div class="card-group">
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Exibe a mensagem de sucesso por alguns segundos
window.onload = function() {
    var message = document.getElementById('message');
    if (message) {
        setTimeout(function() {
            message.classList.remove('show');
        }, 2000); // Mensagem some após 2 segundos
    }
}

    </script>
</main>
</body>
</html>

<?php
$localhost = "localhost";
$user = "root";
$passw = "";
$banco = "hospital";

$conn = new mysqli($localhost, $user, $passw, $banco);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = md5($_POST['senha']);
    $role = $_POST['role']; // Adiciona o campo role

    $sql = "INSERT INTO usuarios (nome, email, senha, role, sit) VALUES (?, ?, ?, ?, 1)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nome, $email, $senha, $role); // Inclui o campo role

    if ($stmt->execute()) {
        echo "
      <div class=\"alert alert-success\" style=\"max-width:400px; margin:auto;\" role=\"alert\">
          Conta ciada com <strong>sucesso!</strong>
          <button type=\"button\" class=\"btn-close\" style=\"float:right;\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
      </div>
      ";
        exit;
    } else {
        echo "Erro ao cadastrar: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

