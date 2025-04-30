<?php
$localhost = "localhost";
$user = "root";
$passw = "";
$banco = "hospital";

$conn = new mysqli($localhost, $user, $passw, $banco);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$id = isset($_POST['id']) ? $_POST['id'] : '';
if (empty($id)) {
    die('ID não fornecido.');
}

$sql = "DELETE FROM consultas WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "Consulta deletada com sucesso!";
} else {
    echo "Erro ao deletar consulta: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
