<?php
    if(
        isset($_GET['id']) &&
        !empty($_GET['id'])
    ){
        require_once 'connexion.php';
        $id = htmlspecialchars($_GET['id']);
        $delete = $pdo->prepare('DELETE FROM plat WHERE id = :id');
        $delete->bindParam(':id',$id);
        $delete->execute();
        header('location:index.php');
    }
    else{
        echo 'Erreur de connexion';
    }
