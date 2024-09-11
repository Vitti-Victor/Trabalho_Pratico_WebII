<?php
// Incluir o arquivo de conexão com o banco de dados
include('../config/db.php');
session_start();
$user_id = $_SESSION['user_id'];

// Processar o formulário se for enviado via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];
    $observacoes = $_POST['observacoes'];
    $observacoes = $_POST['observacoes'];

    // Inserir os dados no banco de dados
    $stmt = $pdo->prepare("INSERT INTO contatos (user_id, nome_completo, telefone, email, endereco, observacoes) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$user_id, $nome, $telefone, $email, $endereco, $observacoes]);

    // Redirecionar para a página inicial após adicionar o contato
    header('Location: home.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Contato</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78IYQzkn2Jk91k0WsC0T9YFS5NDRas1ltljJmZMI5M5bGpgh29jJ3v+" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f1f2f6;
            color: #2c3e50;
        }

        .card {
            margin: 60px auto;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .card h2 {
            font-size: 24px;
            font-weight: 600;
            color: #34495e;
            text-align: center;
            margin-bottom: 30px;
        }

        .form-label {
            font-size: 16px;
            font-weight: 600;
            color: #34495e;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #ced4da;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 8px rgba(52, 152, 219, 0.2);
        }

        .btn-primary {
            background-color: #3498db;
            border-color: #3498db;
            border-radius: 8px;
            font-weight: 600;
            padding: 10px;
            transition: background-color 0.3s ease, transform 0.2s;
        }

        .btn-primary:hover {
            background-color: #2980b9;
            transform: scale(1.05);
        }

        .btn-primary:active {
            background-color: #2471a3;
        }

        .form-text {
            font-size: 14px;
            color: #7f8c8d;
        }

        .container {
            max-width: 500px;
            padding: 0 15px;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .card {
                margin: 30px 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <h2>Adicionar Novo Contato</h2>
                    
                    <!-- Formulário de adição de contato -->
                    <form method="POST">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome Completo</label>
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome completo" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="telefone" class="form-label">Telefone</label>
                            <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Digite o telefone" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Digite o e-mail" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="endereco" class="form-label">Endereço</label>
                            <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Digite o endereço">
                        </div>
                        
                        <div class="mb-3">
                            <label for="observacoes" class="form-label">Observações</label>
                            <textarea class="form-control" id="observacoes" name="observacoes" rows="3" placeholder="Digite observações sobre o contato"></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100">Adicionar Contato</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka3Wq5Dmz6uMBtRaK3oB6y9fv8xKlE2I9v7z6oErbO79Rq3EVJmOC8Pb9XRA1pjn" crossorigin="anonymous"></script>
</body>
</html>
