<?php

    require_once 'connexion.php';
    $result = $pdo->prepare(
                                'SELECT *
                                FROM plat
                            ');

   if($result->execute()){
     while($plat =$result->fetch()){?>
         <tr>
             <td><?=$plat['id']?></td>
             <td><?=$plat['nom']?></td>
             <td><?=$plat['prix']?></td>
             <td><?=$plat['categorie']?></td>
             <td><a class="btn btn-danger" data-id=<?=$plat['id']?> href="supprimer.php?id=<?=$plat['id']?>"><span class="glyphicon glyphicon-remove"</a></td>
             <td><a class="btn btn-info" href="modifierForm.php?id=<?=$plat['id']?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
         </tr>
     <?php
     }
   }
   else{?>
     <td class="alert alert-danger">Aucune donnée n'a été chargé depuis la base de données</td>
   <?php
 }?>
