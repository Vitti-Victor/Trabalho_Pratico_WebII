<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">


<?php
include('../config/db.php');
session_start();
$user_id = $_SESSION['user_id'];
$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];
    $observacoes = $_POST['observacoes'];

    $stmt = $pdo->prepare("UPDATE contatos SET nome_completo = ?, telefone = ?, email = ?, endereco = ?, observacoes = ? WHERE id = ? AND user_id = ?");
    $stmt->execute([$nome, $telefone, $email, $endereco, $observacoes, $id, $user_id]);

    header('Location: home.php');
}

$stmt = $pdo->prepare("SELECT * FROM contatos WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $user_id]);
$contato = $stmt->fetch();
?>

<form method="POST">
    Nome: <input type="text" name="nome" value="<?= $contato['nome_completo']; ?>" required><br>
    Telefone: <input type="text" name="telefone" value="<?= $contato['telefone']; ?>" required><br>
    Email: <input type="email" name="email" value="<?= $contato['email']; ?>" required><br>
    Endereço: <input type="text" name="endereco" value="<?= $contato['endereco']; ?>"><br>
    Observações: <textarea name="observacoes"><?= $contato['observacoes']; ?></textarea><br>
    <button type="submit">Atualizar Contato</button>
</form>
