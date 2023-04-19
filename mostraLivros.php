<?php

require_once('conectaBD.php');

$sql = 'SELECT * FROM livros_cad ORDER BY id ASC';

try {
    $stmt = $pdo->prepare($sql);

    $resultado = $stmt->execute();

    if ($resultado == true) {
        $livros = $stmt->fetchAll();
    }
} catch (PDOException $e) {
    echo 'Falha ao obter todos os livros. Tente novamente mais tarde.';
    die($e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostra Livros</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/d295f0147c.js" crossorigin="anonymous"></script>
    <style>
        a{
            color: white;
        }
    </style>
    <script>
        function alterarLivro(id) {
            window.location.href = `alterarLivro.php?id=${id}`;
        }

        function excluiLivro(id){
            let conf = confirm(`Deseja excluir a noticia de id ${id}?`)
            if(conf){
            window.location.href = `excluiLivro.php?id=${id}`;
            }else{
                alert('Operação cancelada');
            }
        }

        function visualizarLivro(id){
            window.location.href = `visualizarLivro.php?id=${id}`;
        }
    </script>
</head>
<body id="mostrarLivros">
    <h3>
            <?php 
                if (!empty($_GET)) {
                    echo $_GET['msg'];
                }
            ?>
        </h3>
<table id="tabela">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Autor</th>
                <th>Gênero</th>
                <th>Data Lançamento</th>
                <th>Descrição</th>
            </tr>
        </thead>
        <tbody>
            <br/>
        <?php foreach ($livros as $liv) { ?>
                <tr>
                    <td><?php echo $liv['id']; ?></td>
                    <td><?php echo $liv['nome']; ?></td>
                    <td><?php echo $liv['autor']; ?></td>
                    <td><?php echo $liv['genero']; ?></td>
                    <td><?php echo $liv['data_lancamento']; ?></td>
                    <td><?php echo $liv['descricao']; ?></td>
                    <td>
                        <button class="btn btn-warning" onclick="alterarLivro(<?php echo $liv['id']; ?>)"><i class="fa-solid fa-pen"></i></button>
                        <button class="btn btn-danger" onclick="excluiLivro(<?php echo $liv['id']; ?>)"><i class="fa-solid fa-trash"></i></button>
                        <button class="btn btn-primary" onclick="visualizarLivro(<?php echo $liv['id']; ?>)"><i class="fa-solid fa-arrow-right"></i></button>
                    </td>
                </tr>
        <?php } ?>
        </tbody>
        <br>
        <div id="buscarLivro">
            <form action="buscaLivro.php">
                <label>Procurar livro pelo nome</label>
                <input type="text" name="nome" id="nome" >
                <button type="submit" name="buscaLivro" class="btn btn-info"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
        <button class="btn btn-info"><a href="index.html">Cadastrar</a></button>
</body>
</html>