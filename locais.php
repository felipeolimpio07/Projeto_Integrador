<?php
include ("verifica.php");
include ("barra.php")
?>
<body style="background-color: #f4f4f4;">
<?php
$localhost = "localhost";
$user = "root";
$passw = "";
$banco = "hospital";

// Cria a conexão
$conn = new mysqli($localhost, $user, $passw, $banco);

// Verifica a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT nome, descricao, imagem FROM locais";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<style>
        .image-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }
        .image-wrapper {
            flex: 0 1 calc(50% - 20px); /* Ajusta a largura das imagens para que duas fiquem lado a lado */
            margin: 10px;
            text-align: center;
            max-width: 550px;
            margin-top: 40px;
        }
        .image-wrapper img {
            width: auto;
            height: 400px;
        }
        h3 {
            margin-top: 20px;
        }
        .botao {
            font-size: 20px;
            background-image: linear-gradient(to right, #00bd00, #006b00);
            width: 100%;
            border-radius: 30px;
            padding: 15px;
            color: white;
            border: 0px;
            outline: 0;
        }
        .botao:hover {
            background-color: #0056b3;
        }
    </style>";
    echo "<div class='image-container'>";
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<div class='image-wrapper'>
                <h3>" . $row['nome'] . "</h3>
                <img src='data:image/jpeg;base64," . base64_encode($row['imagem']) . "' alt='Descrição da imagem'>
                <p>" . $row['descricao'] . "</p>
                <a href='hospitalRocio.php'><button class='botao'>Clique aqui agendar</button></a>
              </div>";
    }
    echo "</div>";
} else {
    echo "0 results";
}
$conn->close();
?>
</body>
