<?php
include ("verifica.php")
?>
<?php
ob_start(); 

include("barra.php");


$localhost = "localhost";
$user = "root";
$passw = "";
$banco = "hospital";


$conn = new mysqli($localhost, $user, $passw, $banco);


if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['paciente']) && isset($_POST['data_consulta']) && isset($_POST['horario_consulta']) && isset($_POST['medico'])) {
        
        $paciente = $_POST['paciente'];
        $data_consulta = $_POST['data_consulta'];
        $horario_consulta = $_POST['horario_consulta'];
        $medico = $_POST['medico'];
        $descricao = $_POST['descricao'] ?? '';

       
        if (!empty($paciente) && !empty($data_consulta) && !empty($horario_consulta) && !empty($medico)) {
            
            $sql = "INSERT INTO consultas (paciente, data_consulta, horario_consulta, medico, descricao) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("sssss", $paciente, $data_consulta, $horario_consulta, $medico, $descricao);
                if ($stmt->execute()) {
                    header("Location: agendar_consulta.php?message=Consulta agendada com sucesso!&type=success");
                    exit();
                } else {
                    echo "<div class='message error'>Erro ao agendar consulta: " . $stmt->error . "</div>";
                }
                $stmt->close();
            } else {
                echo "<div class='message error'>Erro na preparação da consulta: " . $conn->error . "</div>";
            }
        } else {
            echo "<div class='message error'>Todos os campos são obrigatórios.</div>";
        }
    } else {
        echo "<div class='message error'>Por favor, preencha todos os campos do formulário.</div>";
    }
}


$conn->close();

ob_end_flush(); 
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamento de Consultas</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .form-container {
    width: 100px;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
}
    </style>
</head>
<body style="background-color: #f4f4f4;">
<div style="max-width:45%;" class="container">
    <br>
  
    <h2 class="my-4">Agendamento de Doação</h2>
    <form class="card" action="agendar_consulta.php" method="POST">
        <div class="card-group">
            <label for="paciente" class="form-label">Nome do Paciente:</label>
            <?php $nomeUser?>
            <input type="text" id="paciente" name="paciente" class="form-control" required readonly value="<?php echo $nomeUser?>">
        </div>
        <div class="card-group">
            <label for="data_consulta" class="form-label">Data :</label>
            <input type="date" id="data_consulta" name="data_consulta" class="form-control" required>
        </div>
        <div class="card-group">
            <label for="horario_consulta" class="form-label">Horário :</label>
            <input type="time" id="horario_consulta" name="horario_consulta" class="form-control" required>
        </div>
        <div class="card-group">
            <label for="medico" class="form-label">Médico:</label>
            <select type="text" id="medico" name="medico" class="form-control" required>
                <option value="Fernando">Fernando</option>
                <option value="José">José</option>
                <option value="Rodrigo">Rodrigo</option>
                <option value="Marcos">Marcos</option>
            </select>
        </div>
        <div class="card-group">
            <label for="descricao" class="form-label">Descrição:</label>
            <textarea id="descricao" name="descricao" class="form-control"></textarea>
        </div>
        <div class="card-group btn">
            <button style="text-align:center; border-radius:10px; max-width:50%; margin:auto;" type="submit" class="btn btn-primary">Agendar Consulta</button>
        </div>
    </form>

    <?php
    if (isset($_GET['message'])) {
        $message = $_GET['message'];
        $messageClass = $_GET['type'] == 'success' ? 'success' : 'error';
        echo "
        <div class=\"alert alert-success\" style=\"max-width:840px; margin:auto;\" role=\"alert\">
            Consulta agendada com <strong>sucesso!</strong>
            <button type=\"button\" class=\"btn-close\" style=\"float:right;\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
        </div>
        ";;
    }
    ?>
</div>
<script>
    setTimeout(function() {
        const message = document.querySelector('.message');
        if (message) {
            message.style.display = 'none';
        }
    }, 3000);
</script>
</body>
</html>
