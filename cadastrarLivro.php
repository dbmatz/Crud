<?php

require_once('conectaBD.php');

try {
    $sql = 'INSERT INTO livros_cad (nome, autor, genero, data_lancamento, descricao)
    VALUES (:nome, :autor, :genero, :datal, :descr)';

    $dados = array(
        ':nome' => $_POST['nome'],
        ':autor' => $_POST['autor'],
        ':genero' => $_POST['genero'],
        ':datal' => $_POST['datal'],
        ':descr' => $_POST['descricao']
    );
    
    print_r($dados);

    $stmt = $pdo->prepare($sql);

    $resultado = $stmt->execute($dados);

    if ($resultado) {
        header('Location: mostraLivros.php?msg=Livro cadastrado com sucesso!');
    }

} catch (PDOException $e) {
    echo 'Falha ao cadastrar livro';
    die($e->getMessage());
}

?>