<?php
session_start();
require_once '../config/db.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Recupera os dados do usuário
$sql = "SELECT * FROM users WHERE id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['user_id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "Usuário não encontrado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .alert-custom {
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }
        .alert-custom.show {
            opacity: 1;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Editar Perfil</h2>
        <div id="feedback" class="alert alert-success alert-custom" role="alert">
            Perfil atualizado com sucesso!
        </div>
        <div id="error" class="alert alert-danger alert-custom" role="alert">
            Ocorreu um erro ao atualizar o perfil. Tente novamente.
        </div>
        <form id="profileForm" action="update_profile.php" method="POST">
            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user['id']); ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Nome Completo</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input type="password" class="form-control" id="password" name="password">
                <small class="form-text text-muted">Deixe em branco para manter a senha atual.</small>
            </div>
            <button type="submit" class="btn btn-primary">Atualizar</button>
        </form>
        <a href="home.php" class="btn btn-secondary mt-3">Voltar</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('profileForm').addEventListener('submit', function(event) {
            event.preventDefault();
            var form = event.target;
            var formData = new FormData(form);
            
            fetch(form.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('feedback').classList.add('show');
                    setTimeout(() => {
                        document.getElementById('feedback').classList.remove('show');
                    }, 3000);
                } else {
                    document.getElementById('error').textContent = data.message;
                    document.getElementById('error').classList.add('show');
                    setTimeout(() => {
                        document.getElementById('error').classList.remove('show');
                    }, 3000);
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                document.getElementById('error').textContent = "Ocorreu um erro inesperado. Tente novamente.";
                document.getElementById('error').classList.add('show');
                setTimeout(() => {
                    document.getElementById('error').classList.remove('show');
                }, 3000);
            });
        });
    </script>
</body>
</html>
