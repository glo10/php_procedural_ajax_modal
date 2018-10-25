<?php

    require_once 'connexion.php';
    $result = $pdo->prepare(
                                'SELECT * 
                                FROM plat
                            ');
   $result->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/app.css">
    <title>Liste des élèves</title>
</head>
<body>
    <main class="container">
        <h2>Menu</h2>
        <div class="row">
            <form action="list.php" method="POST">
                <input type="text" placeholder="Recherche" name="search">
                <input type="submit" class="btn btn-info" value="Rechercher">
            </form>
            <div>
                <!--a class="btn btn-primary" href="form.php">Ajouter plat</a-->
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Ajouter plat
                </button>
            </div>
        </div>
        <div class="row">
            <table class="table table-striped table-responsive">
                <thead>
                    <th>Identifiant</th>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Catégorie</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    <?php
                        while($plat =$result->fetch()){?>
                            <tr>
                                <td><?=$plat['id']?></td>
                                <td><?=$plat['nom']?></td>
                                <td><?=$plat['prix']?></td>
                                <td><?=$plat['categorie']?></td>
                                <td><a class="btn btn-danger" data-id=<?=$plat['id']?> href="supprimer.php?id=<?=$plat['id']?>">X</a></td>
                                <td><a class="btn btn-warning" href="modifierForm.php?id=<?=$plat['id']?>">!</a></td>
                            </tr>
                        <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter un plat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" name="name" id="name" placeholder="Saisir le nom du plat">
                    </div>
                    <div class="form-group">
                        <input type="number" step="0.01" name="price" id="price" placeholder="Saisir le prix">
                    </div>
                    <div class="form-group">
                        <select name="category" id="category">
                            <?php
                                require_once 'connexion.php';
                                $options = $pdo->prepare('SELECT id,nom FROM categorie');
                                $options->execute();
                                while($option = $options->fetch()){
                                    echo '<option value="'.$option["nom"].'">'.$option["nom"].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="Valider">
                    </div>
                </div>
                </div>
            </div>
        </div>
    </main>
    <script src="jquery/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        (function(){
            $(document).ready(function(){

                $('input[type=submit]').on('click',function(e){
                    console.log('hello world');
                    $.post('ajout.php',
                    {
                    name :     $('#name').val(),
                    price:     $('#price').val(),
                    category:  $('#category').val()
                    },
                    function(data){
                        console.log(data);
                    });
                });

                $('td>a').on('click',function(e){
                    console.log('hello world');
                    $.get('supprimer.php',
                    {
                    id : $(this).data-id
                    },
                    function(data){
                        console.log(data);
                    });
                });
            });
        })();
    </script>
</body>
</html>