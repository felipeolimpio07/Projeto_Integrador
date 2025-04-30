<?php
include ("verifica.php");
include ("barra.php")
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Locais</title>
    <style>
        body {
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            color: #4CAF50;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-group button:hover {
            background-color: #45a049;
        }

        .image-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .image-wrapper {
            margin: 10px;
            text-align: center;
        }

        .image-wrapper img {
            width: 100%;
            max-width: 300px;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Cadastro de Locais</h2>
        <form action="cadastrar_local.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao" required></textarea>
            </div>
            <div class="form-group">
                <label for="imagem">Imagem:</label>
                <input type="file" id="imagem" name="imagem" accept="image/*" required>
            </div>
            <div class="form-group">
                <button type="submit" style="background:#00bd00">Cadastrar</button>
            </div>
        </form>

        <div class="image-container">
            <div class="image-wrapper">
                <img id="imagem-preview" src="#" alt="Pré-visualização da imagem" style="display:none;">
            </div>
            <div class="image-wrapper">
                <img id="imagem-preview-2" src="#" alt="Pré-visualização da imagem" style="display:none;">
            </div>
        </div>
    </div>

    <script>
        document.getElementById('imagem').onchange = function(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var img1 = document.getElementById('imagem-preview');
                var img2 = document.getElementById('imagem-preview-2');
                img1.src = reader.result;
                img2.src = reader.result;
                img1.style.display = 'block';
                img2.style.display = 'block';
            }
            reader.readAsDataURL(event.target.files[0]);
        };
    </script>
</body>
</html>