<?php
session_start();
require_once('conexao.php');

$tarefas = [];

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit; 
} else {
    $idTarefa = mysqli_real_escape_string($conn, $_GET['id']);

    $sql = "SELECT * FROM tarefa WHERE id = '{$idTarefa}'";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        $tarefas = mysqli_fetch_array($query);
    } else {
        header('Location: index.php');
        exit;
    }
}

if (isset($_POST['editar_tarefa'])) {
    $nome = mysqli_real_escape_string($conn, $_POST['txtNome']);
    $descricao = mysqli_real_escape_string($conn, $_POST['txtDescricao']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $dataLimite = mysqli_real_escape_string($conn, $_POST['txtLimite']);

    $atualizarBanco = "UPDATE tarefa SET nome = '{$nome}', descricao = '{$descricao}', status = '{$status}', data_limite = '{$dataLimite}' WHERE id = '{$idTarefa}'";

    if (mysqli_query($conn, $atualizarBanco)) {
        header('Location: index.php');
        exit;
    } else {
        echo "<div class='alert alert-danger'>Erro ao atualizar tarefa.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar tarefa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
<div class="container mt-4">
    <?php if ($tarefas) : ?>
        <form action="editar_tarefa.php?id=<?=$tarefas['id']?>" method="POST">
            <input type="hidden" name="tarefa_id" value="<?=$tarefas['id']?>">

            <div class="mb-3">
                <label for="txtNome">Nome</label>
                <input type="text" name="txtNome" id="txtNome" value="<?=$tarefas['nome']?>" class="form-control">
            </div>

            <div class="mb-3">
                <label for="txtDescricao">Descrição</label>
                <textarea rows="4" name="txtDescricao" id="txtDescricao" value="<?=$tarefas['descricao']?>" class="form-control"><?=$tarefas['descricao']?></textarea>
            </div>

            <div class="mb-3">
                <label for="txtStatus">Status da tarefa</label><br>
        
                <label><input type="radio" name="status" value="0" <?= $tarefas['status'] == '0' ? 'checked' : '' ?>> Pendente</label>
                <label><input type="radio" name="status" value="1" <?= $tarefas['status'] == '1' ? 'checked' : '' ?>> Em execução</label>
                <label><input type="radio" name="status" value="2" <?= $tarefas['status'] == '2' ? 'checked' : '' ?>> Concluída</label>
            </div>

            <div class="mb-3">
                <label for="txtLimite">Data limite</label>
                <input type="date" name="txtLimite" id="txtLimite" value="<?=$tarefas['data_limite']?>" class="form-control">
            </div>

            <div class="mb-3">
                <button type="submit" name="editar_tarefa" class="btn btn-success">Salvar</button>
            </div>
        </form>
    <?php else : ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            Tarefa não encontrada.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>