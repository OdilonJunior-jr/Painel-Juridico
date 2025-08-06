<?php
session_start();
if (isset($_SESSION['user_type'])) {
    if ($_SESSION['user_type'] === 'admin') {
        header("Location: painel_advogado.php");
    } else {
        header("Location: painel_cliente.php");
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema Jurídico</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>⚖️ Sistema Processual</h1>
            <p>Acompanhamento de Processos Jurídicos</p>
        </div>

        <div class="login-card">
            <div class="tabs">
                <button class="tab active" onclick="switchTab('client')">👤 Cliente</button>
                <button class="tab" onclick="switchTab('admin')">👨‍💼 Advogado</button>
            </div>

            <div id="clientLogin">
                <form action="painel_cliente.php" method="POST">
                    <div class="form-group">
                        <label>CPF:</label>
                        <input type="text" name="cpf" required>
                    </div>
                    <div class="form-group">
                        <label>Senha:</label>
                        <input type="password" name="senha" required>
                    </div>
                    <button class="btn btn-primary" type="submit">Entrar</button>
                </form>
            </div>

            <div id="adminLogin" class="hidden">
                <form action="painel_advogado.php" method="POST">
                    <div class="form-group">
                        <label>Senha do Advogado:</label>
                        <input type="password" name="senha" required>
                    </div>
                    <button class="btn btn-primary" type="submit">Entrar</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function switchTab(tab) {
            document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
            event.target.classList.add('active');
            document.getElementById('clientLogin').classList.add('hidden');
            document.getElementById('adminLogin').classList.add('hidden');
            if (tab === 'client') {
                document.getElementById('clientLogin').classList.remove('hidden');
            } else {
                document.getElementById('adminLogin').classList.remove('hidden');
            }
        }
    </script>
</body>
</html>
