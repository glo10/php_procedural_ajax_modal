<?php

    require_once 'connexion.php';
    $result = $pdo->prepare(
                                'SELECT *
                                FROM plat
                            ');
    
   if($result->execute()){
    $data = $result->fetchAll(PDO::FETCH_ASSOC);
    $data = json_encode($data);
    echo $data;
   }
   else{
     echo "Aucune information a été recupéré!";
   }
