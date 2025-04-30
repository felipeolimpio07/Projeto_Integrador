<?php
include ("verifica.php")
?>
<?php
include("barra.php");

$localhost = "localhost";
$user = "root";
$passw = "";
$banco = "hospital";

$conn = new mysqli($localhost, $user, $passw, $banco);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$medico = isset($_POST['medico']) ? $_POST['medico'] : '';

$sql = "SELECT id, paciente, data_consulta, horario_consulta, medico, descricao FROM consultas";
if (!empty($medico)) {
    $sql .= " WHERE medico = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $medico);
} else {
    $stmt = $conn->prepare($sql);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultas Agendadas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .alert-fixed {
            position: fixed;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            max-width: 600px;
            z-index: 1000;
            text-align: center;
            display: none;
        }
    </style>
</head>
<body style="background-color: #f4f4f4;">
<div class="container">
    <h2 class="my-4">Consultas Agendadas</h2>

    <div class="alert alert-success alert-fixed" id="delete-message">Consulta deletada com sucesso!</div>

    <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
        <div class="alert alert-success" role="alert" id="success-message">Consulta atualizada com sucesso!</div>
        <script>
            setTimeout(function() {
                const message = document.getElementById('success-message');
                if (message) {
                    message.style.display = 'none';
                }
            }, 2000); 
        </script>
    <?php endif; ?>

    <form action="consultas_agendadas.php" method="POST" class="mb-4">
        <label for="medico">Filtrar por Médico:</label>
        <select id="medico" name="medico" class="form-select">
            <option value="">Selecione um médico</option>
            <?php
            $medicos_sql = "SELECT DISTINCT medico FROM consultas";
            $medicos_result = $conn->query($medicos_sql);

            while ($medico_row = $medicos_result->fetch_assoc()) {
                $selected = $medico === $medico_row['medico'] ? 'selected' : '';
                echo "<option value='" . $medico_row['medico'] . "' $selected>" . $medico_row['medico'] . "</option>";
            }
            ?>
        </select>
        <button type="submit" class="btn mt-3" style="color:white; background:#00bd00;">Filtrar</button>
    </form>

    <table class="table table-bordered" style="background:white;">
        <thead>
        <tr>
            <th>Paciente</th>
            <th>Data</th>
            <th>Horário</th>
            <th>Médico</th>
            <th>Descrição</th>
            <?php if($role == 'admin'){ ?>
            <th>Ações</th><?php
            }?>
            
        </tr>
        </thead>
        <tbody id="consulta-table-body">
        <?php while ($consulta = $result->fetch_assoc()): ?>
            <tr id="consulta-row-<?= $consulta['id'] ?>">
                <td><?= $consulta['paciente'] ?></td>
                <td><?= $consulta['data_consulta'] ?></td>
                <td><?= $consulta['horario_consulta'] ?></td>
                <td><?= $consulta['medico'] ?></td>
                <td><?= $consulta['descricao'] ?></td>
                <td>
                <?php if($role == 'admin'){ ?>
                    <form action="editar_consulta.php" method="GET" style="display:inline-block;">
                        <input type="hidden" name="id" value="<?= $consulta['id'] ?>">
                        <button type="submit" class="btn" style="color:white; background:#00bd00">Editar</button>
                    </form>
                    <button onclick="deletarConsulta(<?= $consulta['id'] ?>)" class="btn btn-danger">Deletar</button>
                    <?php
                }
                ?>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script>
    function deletarConsulta(id) {
        $.ajax({
            url: 'deletar_consulta.php',
            type: 'POST',
            data: { id: id },
            success: function(response) {
                $('#consulta-row-' + id).remove();
                $('#delete-message').fadeIn('slow').delay(2000).fadeOut('slow');
            },
            error: function() {
                alert('Erro ao deletar consulta.');
            }
        });
    }
</script>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
