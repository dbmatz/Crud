<?php

require_once('conectaBD.php');

try{
    $sql = 'UPDATE livros_cad 
    SET nome = :nome, autor = :autor, genero = :genero, data_lancamento = :datal, descricao = :descricao 
    WHERE id = :id';
    
    $dados = array(
        ':id' => $_POST['id'],
        ':nome' => $_POST['nome'],
        ':autor' => $_POST['autor'],
        ':genero' => $_POST['genero'],
        ':datal' => $_POST['datal'],
        ':descricao' => $_POST['descricao']
    );

    $stmt = $pdo->prepare($sql); 

    $resultado = $stmt->execute($dados);
    if($resultado == true){
        echo 'Livro Atualizado!';
        header('Location: mostraLivros.php?msg=Livro alterado com sucesso!');
    }

    }catch(PDOException $e){
        echo 'Falha ao alterar livro';
        die($e->getMessage());
    }

?>