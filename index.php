<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/app.css">
    <title>Menu</title>
</head>
<body>
    <main class="container">
        <h2>Menu</h2>
        <div class="row">
            <!--
            <form action="list.php" method="POST">
                <input type="text" placeholder="Recherche" name="search">
                <input type="submit" class="btn btn-info" value="Rechercher">
            </form>
            -->
            <div>
                <button id="add" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal">
                  Ajouter un plat&nbsp;<span class="glyphicon glyphicon-plus"></span>
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
                <tbody></tbody>
            </table>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Ajouter un plat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="id" value="-1">
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
                                while($option = $options->fetch()){?>
                                    <option value="<?=$option['id']?>"><?=$option["nom"]?></option>
                                <?php
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
    <script src="js/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="js/app.js"></script>
</body>
</html>
