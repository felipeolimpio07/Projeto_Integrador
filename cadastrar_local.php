<?php
$localhost = "localhost";
$user = "root";
$passw = "";
$banco = "hospital";


$conn = new mysqli($localhost, $user, $passw, $banco);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $imagem = addslashes(file_get_contents($_FILES['imagem']['tmp_name']));

    $sql = "INSERT INTO locais (nome, descricao, imagem) VALUES ('$nome', '$descricao', '$imagem')";

    if ($conn->query($sql) === TRUE) {
        echo "Local cadastrado com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
