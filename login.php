<?php
    include("barra.php")
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Acesso</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body style="background-color: #f4f4f4;">
    <form class="form" action="login.php" method="POST">
        <div class="card">
            <div class="card-top">
                <img class="imglogin" src="img/user.png" alt="">
                <h2 class="title">Seja Bem Vindo</h2>
            </div>
            <div class="card-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="Digite seu email" required>
            </div>
            <br>
            <div class="card-group">
                <label>Senha</label>
                <input type="password" name="senha" placeholder="Digite sua senha" required>
            </div>
            <br>
            <div class="card-group btn">
                <button type="submit">Acessar</button>
            </div>
            <a href="cad_usuario.php">Não possui uma conta? cadastre-se</a>
        </div>
    </form>
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
    $email = $_POST['email'];
    $senha = md5($_POST['senha']);

    $sql = "SELECT idusuario, nome, role FROM usuarios WHERE email = ? AND senha = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $senha);
    $stmt->execute();
    $stmt->bind_result($id, $nome, $role);
    $stmt->fetch();

    if ($id) {
        $_SESSION['idUser'] = $id;
        $_SESSION['nome'] = $nome;
        $_SESSION['role'] = $role;
        header("Location:dashboard.php");   
        exit();
    } else {
        echo "Email ou senha incorretos";
    }
    $stmt->close();
}
$conn->close();
?>

