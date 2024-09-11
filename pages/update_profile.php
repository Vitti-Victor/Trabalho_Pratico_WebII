<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Usuário não autenticado']);
    exit;
}

$user_id = $_POST['user_id'];
$name = $_POST['name'];
$email = $_POST['email'];
$password = isset($_POST['password']) ? $_POST['password'] : '';

// Verifica se a senha foi preenchida
if (!empty($password)) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "UPDATE users SET name = :name, email = :email, password = :password WHERE id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['name' => $name, 'email' => $email, 'password' => $hashedPassword, 'user_id' => $user_id]);
} else {
    $sql = "UPDATE users SET name = :name, email = :email WHERE id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['name' => $name, 'email' => $email, 'user_id' => $user_id]);
}

echo json_encode(['success' => true, 'message' => 'Perfil atualizado com sucesso']);
?>
