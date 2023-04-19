<?php

require_once('conectaBD.php');

$sql = 'SELECT * FROM livros_cad WHERE id = :id';

try {
    $stmt = $pdo->prepare($sql);

    $dados = array(
        ':id' => $_GET['id']
    );

    $resultado = $stmt->execute($dados);
    
        if ($resultado == true) {
            $livros = $stmt->fetchAll();
        }
} catch (PDOException $e) {
    echo 'Falha ao obter o livro. Tente novamente mais tarde.';
    die($e->getMessage());
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Livro</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Visualizar Livro</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/d295f0147c.js" crossorigin="anonymous"></script>
    <style>
        .botao{
            margin: 10px;
        }
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
    </script>
</head>
<body>
       
       <div id="visualizar">
        
            <h1 class="nomeador"><?php echo $livros[0]['nome']; ?></h1>
            <p class="clas">Autor</p>
            <h4><?php echo $livros[0]['autor']; ?></h4>
            <p class="clas">Gênero</p>
            <h4><?php echo $livros[0]['genero']; ?></h4>
            <p class="clas">Data de lançamento</p>
            <h4><?php echo $livros[0]['data_lancamento']; ?></h4>
            <p class="clas">Descrição</p>
            <p><?php echo $livros[0]['descricao']; ?></p>
            <div id="botoes">
            <button class="btn btn-primary"><a href="mostraLivros.php"><i class="fa-solid fa-arrow-left"></i></a></button>

            <button class="btn btn-warning" onclick="alterarLivro(<?php echo $livros[0]['id']; ?>);"><i class="fa-solid fa-pen"></i></button>

            <button class="btn btn-danger" onclick="excluiLivro(<?php echo $livros[0]['id']; ?>);"><i class="fa-solid fa-trash"></i></button>
        </div>
        </div>
        
        <br>

</body>
</html>