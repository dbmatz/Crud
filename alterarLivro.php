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
    echo 'Falha ao obter todas os livros. Tente novamente mais tarde.';
    die($e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Notícia</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/d295f0147c.js" crossorigin="anonymous"></script>
    <style>        
        td, th {
            border: 1px solid;
        }
        #id{
            display: none;
        }
    </style>
</head>
<body>
    <form action="updateLivro.php" method="post">
        <div id="container">
            <h1>Alterar Livro</h1>
                <div>
                     <input name="id" id="id" value="<?php echo $livros[0]['id']; ?>">
                </div>
                <div>
                    <label>Nome:</label>
                     <br/>
                     <input type="text" name="nome" id="nome" value="<?php echo $livros[0]['nome']; ?>">
                </div>
                <div>
                    <label>Autor:</label>
                    <br/>
                    <input type="text" name="autor" id="autor" value="<?php echo $livros[0]['autor']; ?>"></input>
                </div>
                <div>
                    <label>Gênero:</label>
                    <br/>
                    <input type="text" name="genero" id="genero" value="<?php echo $livros[0]['genero']; ?>">
                </div>
                <div>
                    <label>Data de Lançamento:</label>
                    <br/>
                    <input type="text" name="datal" id="datal" value="<?php echo $livros[0]['data_lancamento']; ?>">
                </div>
                <div>
                    <label>Descrição:</label>
                    <br/>
                    <textarea name="descricao" id="descricao"><?php echo $livros[0]['descricao']; ?></textarea>
                </div>
                <div>
                <button type="submit" name="alterarLivro" class="btn-success">Alterar</button>
                </div>
        </div>
    </form>
</body>
</html>