<?php
    print_r($_POST);
    if(
        isset($_POST['id'])         &&
        !empty($_POST['id'])        &&
        isset($_POST['name'])       &&
        !empty($_POST['name'])      &&
        isset($_POST['price'])      &&
        !empty($_POST['price'])     &&
        isset($_POST['category'])   &&
        !empty($_POST['category'])
    ){
        array_map($_POST,htmlspecialchars);
        require_once 'connexion.php';

        $id = $_POST['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $category = $_POST['category'];

        $update = $pdo->prepare('   UPDATE  plat 
                                    SET     nom = :nom, 
                                            prix = :prix, 
                                            categorie = :categorie 
                                    WHERE   id = :id'
                                );

        $update->bindParam(':id',$id);
        $update->bindParam(':nom',$name);
        $update->bindParam(':prix',$price);
        $update->bindParam(':categorie',$category);

        $update->execute();
        header('location:list.php');
    }
    else{
        echo 'itiidojd';
    }