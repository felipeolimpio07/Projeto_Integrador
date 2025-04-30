<?php
ob_start(); // Iniciar o buffer de saída

include("barra.php");

// Configurações do banco de dados
$localhost = "localhost";
$user = "root";
$passw = "";
$banco = "hospital";

// Conectar ao banco de dados usando mysqli
$conn = new mysqli($localhost, $user, $passw, $banco);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $paciente = $_POST['paciente'];
    $data_consulta = $_POST['data_consulta'];
    $horario_consulta = $_POST['horario_consulta'];
    $medico = $_POST['medico'];
    $descricao = $_POST['descricao'];

    // Preparar a consulta SQL para atualização
    $sql = "UPDATE consultas SET paciente=?, data_consulta=?, horario_consulta=?, medico=?, descricao=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $paciente, $data_consulta, $horario_consulta, $medico, $descricao, $id);

    if ($stmt->execute()) {
        header('Location: consultas_agendadas.php?status=success');
        exit();
    } else {
        echo "<div class='alert alert-danger' role='alert'>Erro ao atualizar consulta: " . $stmt->error . "</div>";
    }

    $stmt->close();
    $conn->close();
}

// Verificar se o ID está sendo recebido no método GET
$id = isset($_GET['id']) ? $_GET['id'] : '';
if (empty($id)) {
    die('ID não fornecido.');
}

$sql = "SELECT * FROM consultas WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$consulta = $result->fetch_assoc();

if (!$consulta) {
    die('Consulta não encontrada.');
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Consulta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="my-4">Editar Consulta</h2>

    <form action="editar_consulta.php?id=<?= $consulta['id'] ?>" method="POST">
        <input type="hidden" name="id" value="<?= $consulta['id'] ?>">
        <div class="mb-3">
            <label for="paciente" class="form-label">Paciente:</label>
            <input type="text" id="paciente" name="paciente" class="form-control" value="<?= $consulta['paciente'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="data_consulta" class="form-label">Data:</label>
            <input type="date" id="data_consulta" name="data_consulta" class="form-control" value="<?= $consulta['data_consulta'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="horario_consulta" class="form-label">Horário:</label>
            <input type="time" id="horario_consulta" name="horario_consulta" class="form-control" value="<?= $consulta['horario_consulta'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="medico" class="form-label">Médico:</label>
            <input type="text" id="medico" name="medico" class="form-control" value="<?= $consulta['medico'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição:</label>
            <textarea id="descricao" name="descricao" class="form-control" required><?= $consulta['descricao'] ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    </form>

    <form action="deletar_consulta.php" method="POST" class="mt-3">
        <input type="hidden" name="id" value="<?= $consulta['id'] ?>">
        <button type="submit" class="btn btn-danger">Deletar Consulta</button>
    </form>
</div>
</body>
</html>

<?php
ob_end_flush(); // Liberar o buffer de saída
?>
