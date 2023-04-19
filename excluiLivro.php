<?php

require_once('conectaBD.php');

$sql = 'DELETE FROM livros_cad WHERE id = :id';

try{
    $stmt = $pdo->prepare($sql);

    $dados = array (
    ':id' => $_GET['id']
    );

    $resultado = $stmt->execute($dados);
    if($resultado == true){
        echo 'Livro excluido!';
        header('Location: mostraLivros.php?msg=Livro excluido com sucesso!');
    }else{
        echo 'Não foi possível excluir o livro';
        header('Location: mostraLivros.php?msg=Livro não excluido');
    }

}catch(PDOException $e){
    echo 'Falha ao excluir livro';
    die($e->getMessage());
}

?>