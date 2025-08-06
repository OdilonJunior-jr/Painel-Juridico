<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new SQLite3('db/database.sqlite');
    $stmt = $db->prepare("INSERT INTO clientes (nome, cpf, email, telefone, numero_processo, tipo_processo, senha) 
                          VALUES (:nome, :cpf, :email, :telefone, :numero_processo, :tipo_processo, :senha)");
    $stmt->bindValue(':nome', $_POST['nome']);
    $stmt->bindValue(':cpf', $_POST['cpf']);
    $stmt->bindValue(':email', $_POST['email']);
    $stmt->bindValue(':telefone', $_POST['telefone']);
    $stmt->bindValue(':numero_processo', $_POST['numero_processo']);
    $stmt->bindValue(':tipo_processo', $_POST['tipo_processo']);
    $stmt->bindValue(':senha', $_POST['senha']);
    $stmt->execute();
    header("Location: painel_advogado.php");
    exit;
}
?>
