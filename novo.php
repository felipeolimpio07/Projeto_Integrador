

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
        .form-container input, .form-container textarea, .form-container select {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
        }
        .form-container button {
            padding: 10px 20px;
            background-color: #00bd00;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        html, body {
            height: 70%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-container {
            width: 200px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
    </style>
</head>
<body>
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
                <input type="text" id="nome" name="nome" placeholder="digite seu nome" required><br>
            </div>
            <div class="card-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="digite seu email" required><br>
            </div>
            <div class="card-group">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" placeholder="digite sua senha" required><br>
            </div>
            <div class="card-group">
                <label for="role">Papel:</label>
                <select id="role" name="role" required>
                    <option value="user">Usuário Comum</option>
                    <option value="admin">Administrador</option>
                </select><br>
            </div><br/>
            <div class="card-group btn">
                <button type="submit">Cadastrar</button>
            </div>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showMessage() {
            const message = document.getElementById('message');
            message.classList.add('show');
            setTimeout(() => {
                message.classList.remove('show');
            }, 3000);
        }

        <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
        showMessage();
        <?php endif; ?>
    </script>
</body>
</html>
