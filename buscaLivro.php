<?php

require_once('conectaBD.php');

$sql = 'SELECT * FROM livros_cad WHERE nome = :nome';

try{
    $stmt = $pdo->prepare($sql);

    $dados = array (
        ':nome' => $_GET['nome']
    );

    $resultado = $stmt->execute($dados);
    if($resultado){
        $livros = $stmt->fetchAll();
    }else{
        header('Location: mostraLivros.php?msg=Livro não encontrado');
    }

}catch(PDOException $e){
    header('Location: mostraLivros.php?msg=Livro não encontrado');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Livro</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/d295f0147c.js" crossorigin="anonymous"></script>
    <style>
        .botao{
            margin: 10px;
        }
    </style>
    <script>
        function alterarLivro(id) {
            window.location.href = `alterarLivro.php?id=${id}`;
        }

        function excluiLivro(id){
            let conf = confirm(`Deseja apagar o livro de ID numero ${id}?`);
            if(conf == true){
                window.location.href = `excluiLivro.php?id=${id}`;
            }
        }

        function visualizarLivro(id){
            window.location.href = `visualizarLivro.php?id=${id}`;
        }
    </script>
</head>
<body id="mostrarLivros">
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
        <?php foreach ($livros as $liv) { ?>
                <tr>
                    <td><?php echo $liv['id']; ?></td>
                    <td><?php echo $liv['nome']; ?></td>
                    <td><?php echo $liv['autor']; ?></td>
                    <td><?php echo $liv['genero']; ?></td>
                    <td><?php echo $liv['data_lancamento']; ?></td>
                    <td><?php echo $liv['descricao']; ?></td>
                    <td>
                        <button class="btn btn-warning" onclick="alterarLivro(<?php echo $liv['id']; ?>);"><i class="fa-solid fa-pen"></i></button>
                        <button class="btn btn-danger" onclick="excluiLivro(<?php echo $liv['id']; ?>);"><i class="fa-solid fa-trash"></i></button>
                        <button class="btn btn-primary" onclick="visualizarLivro(<?php echo $liv['id']; ?>)"><i class="fa-solid fa-arrow-right"></i></button>
                    </td>
                </tr>
        <?php } ?>
        </tbody>
        <br>
        <!--<button><a href="index.html">Cadastrar novo livro</a></button>-->

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
