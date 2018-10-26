<?php
    if(
        isset($_POST['id']) &&
        !empty($_POST['id'])
    ){
        require_once 'connexion.php';
        $id = htmlspecialchars($_POST['id']);
        $delete = $pdo->prepare('DELETE FROM plat WHERE id = :id');
        $delete->bindParam(':id',$id);
        $delete->execute();
    }
    else{
        echo 'Erreur de connexion';
    }
