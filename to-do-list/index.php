<?php
session_start();
require_once("conexao.php");

$sql = "SELECT * FROM tarefa";
$tarefa = mysqli_query($conn, $sql);

if (isset($_POST['excluir_tarefa'])) {
    $tarefaId = mysqli_real_escape_string($conn, $_POST['excluir_tarefa']);
    $sql = "DELETE FROM tarefa WHERE id = '$tarefaId'";
    mysqli_query($conn, $sql);

    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista das tarefas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
<div class="container mt-4">
    <table class="table">
        
        <div class="table table-bordered table-striped"><a href="criarTarefa.php" class="btn btn-success">Criar nova tarefa</a></div>
                            <thead  class="table-group-divider">
                                <tr>
                                    <th>Id</th>
                                    <th>Nome da tarefa</th>
                                    <th>Descrição</th>
                                    <th>Status</th>
                                    <th>Data limite</th>
                                    <th>Modificação</th>
                                </tr>
                            </thead>
                            <tbody  class="table-group-divider">
                                <?php foreach ($tarefa as $tarefas): ?>
                                    <tr>
                                        <td><?php echo $tarefas['id']; ?></td>
                                        <td><?php echo $tarefas['nome']; ?></td>
                                        <td><?php echo $tarefas['descricao']; ?></td>
                                        <td><?php 
                                        if ($tarefas['status'] == 0){
                                            echo "<p style='color: brown;'>Pendente</p>";
                                        }else if ($tarefas['status'] == 1){
                                            echo "<p style='color: blue;'>Em execução</p>";
                                        }else{
                                            echo "<p style='color: green;'>Concluida</p>";
                                        }

                                        ?></td>
                                        <td><?php echo date('d/m/Y', strtotime($tarefas['data_limite'])); ?></td>
                                        <td>
                                            <a href="editar_tarefa.php?id=<?=$tarefas['id']?>" class="btn btn-primary">editar</a>
                                            <form action="index.php" method="POST" class="d-inline">
                                                <button onclick="return confirm('Tem certeza que deseja excluir?')" name="excluir_tarefa" type="submit" value="<?=$tarefas['id']?>" class="btn btn-danger">Excluir tarefa</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
        </table>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>