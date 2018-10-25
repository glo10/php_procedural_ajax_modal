<?php
    if(
        isset($_POST['name'])       && 
        isset($_POST['price'])      && 
        isset($_POST['category'])   && 
        !empty($_POST['name'])      && 
        !empty($_POST['price'])     && 
        !empty($_POST['category']) 
    ){
        require_once 'connexion.php';
        array_map('htmlspecialchars',$_POST);
        $name = $_POST['name'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $insert = $pdo->prepare('
                                    INSERT 
                                    INTO plat(nom,prix,categorie)
                                    VALUES(:nom,:prix,:categorie)
                                ');

        $insert->bindParam(':nom',$name);
        $insert->bindParam(':prix',$price);
        $insert->bindParam(':categorie',$category);

        $insert->execute();
        echo 'true';
    }
    else{
        echo 'probleme';
    }