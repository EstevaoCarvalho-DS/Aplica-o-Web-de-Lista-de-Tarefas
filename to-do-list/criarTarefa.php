<?php
session_start();
require_once('conexao.php');

if (isset($_POST['criarTarefa'])) {
    $nome = trim($_POST['txtNome']);
    $descricao = trim($_POST['txtDescricao']);
    $status = 0;
    $dataLimite = trim($_POST['dataLimite']);
    
    $sql = "INSERT INTO tarefa (nome, descricao, status, data_limite) VALUES('$nome', '$descricao', '$status', '$dataLimite')";

    mysqli_query($conn, $sql);

    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar tarefa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

<div class="container mt-4">
    <form action="" method="POST">
            <div class="mb-3">
                <label for="txtNome">Nome da Tarefa:</label>
                <input type="text" name="txtNome" id="txtNome"  class="form-control">
            </div>

            <div class="mb-3">
                <label for="txtDescricao">Descrição:</label>
                <textarea name="txtDescricao" id="txtDescricao" rows="4" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label for="dataLimite">Data Limite:</label>
                <input type="date" name="dataLimite" id="dataLimite" class="form-control">
            </div>

            <div class="mb-3">
                <button type="submit" name="criarTarefa" class="btn btn-success">Criar Tarefa</button>
            </div>
    </form>
<div>
</body>
</html>
