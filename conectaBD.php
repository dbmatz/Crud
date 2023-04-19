<?php 

try {
    $pdo = new PDO('mysql:host=localhost;dbname=livrosbd;port=3306', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
    echo 'Falha ao conectar ao banco de dados<br/>';
    die($e->getMessage());
}

?>