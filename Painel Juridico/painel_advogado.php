<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['senha'] === 'admin123') {
        $_SESSION['user_type'] = 'admin';
    } else {
        echo "Senha incorreta.";
        exit;
    }
} elseif (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: index.php");
    exit;
}

$db = new SQLite3('db/database.sqlite');
$clientes = $db->query("SELECT * FROM clientes");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel do Advogado</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>👨‍💼 Painel do Advogado</h2>
        <a href="logout.php" class="btn btn-secondary">Sair</a>

        <h3>➕ Cadastrar Cliente</h3>
        <form action="cadastrar.php" method="POST">
            <div class="form-group"><input type="text" name="nome" placeholder="Nome completo" required></div>
            <div class="form-group"><input type="text" name="cpf" placeholder="CPF" required></div>
            <div class="form-group"><input type="text" name="email" placeholder="Email"></div>
            <div class="form-group"><input type="text" name="telefone" placeholder="Telefone"></div>
            <div class="form-group"><input type="text" name="numero_processo" placeholder="Número do Processo" required></div>
            <div class="form-group">
                <select name="tipo_processo" required>
                    <option value="">Tipo do Processo</option>
                    <option value="Trabalhista">Trabalhista</option>
                    <option value="Civil">Civil</option>
                    <option value="Criminal">Criminal</option>
                    <option value="Tributário">Tributário</option>
                    <option value="Previdenciário">Previdenciário</option>
                    <option value="Família">Família</option>
                </select>
            </div>
            <div class="form-group"><input type="text" name="senha" placeholder="Senha do Cliente" required></div>
            <button class="btn btn-success" type="submit">Cadastrar</button>
        </form>

        <h3>📋 Clientes Cadastrados</h3>
        <ul>
            <?php while ($c = $clientes->fetchArray()): ?>
                <li><strong><?= $c['nome'] ?></strong> - CPF: <?= $c['cpf'] ?> | Processo: <?= $c['numero_processo'] ?></li>
            <?php endwhile; ?>
        </ul>
    </div>
</body>
</html>
