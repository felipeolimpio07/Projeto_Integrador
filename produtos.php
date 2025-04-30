<?php
    include("index.php");
?>
<?php

require_once 'conexao.php';


if (isset($_POST['add_to_cart'])) {
    $id_prod = $_POST['id_prod'];
    $quantidade = $_POST['quantidade'] ?? 1;

    if (!isset($_SESSION['carrinho'][$id_prod])) {
        $_SESSION['carrinho'][$id_prod] = $quantidade;
    } else {
        $_SESSION['carrinho'][$id_prod] += $quantidade;
    }
    
    header("Location: index.php?pg=produtos");
    exit();
}


if (isset($_POST['remove_from_cart'])) {
    $id_prod = $_POST['id_prod'];
    unset($_SESSION['carrinho'][$id_prod]);
    header("Location: index.php?pg=produtos");
    exit();
}


if (isset($_POST['finalizar_compra'])) {
    $compras = [];
    $estoque_insuficiente = false;

    foreach ($_SESSION['carrinho'] as $id_prod => $quantidade) {
        $stmt = $pdo->prepare("SELECT nome_prod, estoque_prod FROM produtos WHERE id_prod = :id_prod");
        $stmt->bindParam(':id_prod', $id_prod);
        $stmt->execute();
        $produto = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($produto['estoque_prod'] >= $quantidade) {
            $compras[] = [
                'id_prod' => $id_prod,
                'nome_prod' => $produto['nome_prod'],
                'quantidade' => $quantidade,
                'estoque_atual' => $produto['estoque_prod']
            ];
        } else {
            echo "Estoque insuficiente para {$produto['nome_prod']}.<br>";
            $estoque_insuficiente = true;
        }
    }

    if (!$estoque_insuficiente) {
        try {
            $pdo->beginTransaction();

            foreach ($compras as $compra) {
                $novo_estoque = $compra['estoque_atual'] - $compra['quantidade'];
                $update_stmt = $pdo->prepare("UPDATE produtos SET estoque_prod = :estoque_prod WHERE id_prod = :id_prod");
                $update_stmt->bindParam(':estoque_prod', $novo_estoque);
                $update_stmt->bindParam(':id_prod', $compra['id_prod']);
                $update_stmt->execute();

                $insert_stmt = $pdo->prepare("INSERT INTO vendas (id_prod, quantidade, data_hora) VALUES (:id_prod, :quantidade, NOW())");
                $insert_stmt->bindParam(':id_prod', $compra['id_prod']);
                $insert_stmt->bindParam(':quantidade', $compra['quantidade']);
                $insert_stmt->execute();
            }

            $pdo->commit();
            $_SESSION['carrinho'] = [];
            echo "Compra finalizada com sucesso!";
        } catch (Exception $e) {
            $pdo->rollBack();
            echo "Falha ao finalizar a compra: " . $e->getMessage();
        }
    }
}


$sql = "SELECT p.id_prod, p.nome_prod, s.nome_set, p.custo_prod, p.venda_prod, p.estoque_prod, p.imagem_prod 
        FROM produtos p 
        JOIN setores s ON p.setor_prod = s.id_set 
        WHERE p.situacao_prod = 1";
$produtos_result = $pdo->query($sql);

$produtos_por_setor = [];
while ($produto = $produtos_result->fetch(PDO::FETCH_ASSOC)) {
    $produtos_por_setor[$produto['nome_set']][] = $produto;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="my-4">Produtos Disponíveis</h2>
    
    <?php foreach ($produtos_por_setor as $setor => $produtos): ?>
        <h3><?= htmlspecialchars($setor) ?></h3>
        <div class="row mb-4">
            <?php foreach ($produtos as $produto): ?>
                <div class="col-md-4">
                    <div class="card shadow-sm" style="height: 100%;">
                        <img src="<?= htmlspecialchars($produto['imagem_prod']) ?>" class="card-img-top" alt="Imagem do produto" style="height: 250px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= htmlspecialchars($produto['nome_prod']) ?></h5>
                            <p class="card-text">
                                Preço de Custo: R$ <?= number_format($produto['custo_prod'], 2, ',', '.') ?><br>
                                Preço de Venda: R$ <?= number_format($produto['venda_prod'], 2, ',', '.') ?><br>
                                Estoque: <?= htmlspecialchars($produto['estoque_prod']) ?>
                            </p>
                            <form action="index.php?pg=produtos" method="POST" class="mt-auto">
                                <input type="hidden" name="id_prod" value="<?= $produto['id_prod'] ?>">
                                <div class="mb-3">
                                    <label for="quantidade" class="form-label">Quantidade:</label>
                                    <input type="number" name="quantidade" min="1" value="1" class="form-control" required>
                                </div>
                                <button type="submit" name="add_to_cart" class="btn btn-primary w-100">Adicionar ao Carrinho</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>

    <h2 class="my-4">Carrinho de Compras</h2>
    <ul class="list-group">
        <?php if (empty($_SESSION['carrinho'])): ?>
            <li class="list-group-item">O carrinho está vazio.</li>
        <?php else: ?>
            <?php foreach ($_SESSION['carrinho'] as $id_prod => $quantidade): ?>
                <?php
                $stmt = $pdo->prepare("SELECT nome_prod FROM produtos WHERE id_prod = :id_prod");
                $stmt->bindParam(':id_prod', $id_prod);
                $stmt->execute();
                $produto = $stmt->fetch(PDO::FETCH_ASSOC);
                ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?= htmlspecialchars($produto['nome_prod']) ?> - Quantidade: <?= $quantidade ?>
                    <form action="index.php?pg=produtos" method="POST" class="mb-0">
                        <input type="hidden" name="id_prod" value="<?= $id_prod ?>">
                        <button type="submit" name="remove_from_cart" class="btn btn-danger btn-sm">Remover</button>
                    </form>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>

    <form action="index.php?pg=produtos" method="POST">
        <button type="submit" name="finalizar_compra" class="btn btn-success mt-4" <?= empty($_SESSION['carrinho']) ? 'disabled' : '' ?>>Finalizar Compra</button>
    </form>
</div>
</body>
</html>