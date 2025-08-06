<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];
    $db = new SQLite3('db/database.sqlite');
    $stmt = $db->prepare("SELECT * FROM clientes WHERE cpf = :cpf AND senha = :senha");
    $stmt->bindValue(':cpf', $cpf);
    $stmt->bindValue(':senha', $senha);
    $result = $stmt->execute();
    $cliente = $result->fetchArray(SQLITE3_ASSOC);

    if ($cliente) {
        $_SESSION['user_type'] = 'cliente';
        $_SESSION['cliente'] = $cliente;
    } else {
        echo "Login inválido.";
        exit;
    }
} elseif (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'cliente') {
    header("Location: index.php");
    exit;
}

$cliente = $_SESSION['cliente'];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel do Cliente</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>👤 Bem-vindo, <?= $cliente['nome'] ?></h2>
        <a href="logout.php" class="btn btn-secondary">Sair</a>

        <div class="process-info">
            <p><strong>Número do Processo:</strong> <?= $cliente['numero_processo'] ?></p>
            <p><strong>Tipo:</strong> <?= $cliente['tipo_processo'] ?></p>
            <p><strong>Status:</strong> Em andamento</p>
        </div>

        <h3>📅 Linha do Tempo</h3>
        <ul>
            <?php
            $db = new SQLite3('db/database.sqlite');
            $movs = $db->query("SELECT * FROM movimentacoes WHERE cliente_id = {$cliente['id']} ORDER BY data DESC");
            while ($m = $movs->fetchArray()): ?>
                <li><strong><?= $m['data'] ?></strong>: <?= $m['descricao'] ?></li>
            <?php endwhile; ?>
        </ul>
    </div>
</body>
</html>
