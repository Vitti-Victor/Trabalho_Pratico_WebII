<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">


<?php
include('../config/db.php');
session_start();
$user_id = $_SESSION['user_id'];
$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM contatos WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $user_id]);

header('Location: home.php');
?>
