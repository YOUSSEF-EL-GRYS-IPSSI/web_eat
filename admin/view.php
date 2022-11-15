<?php
require_once 'Database.php';


if (!empty($_GET['id'])) {
    $id = checkInput($_GET['id']);
}

$db = Database::connect();

$statement = $db->prepare('SELECT items.id, items.name, items.description, items.price, items.image, categories.name AS category 
FROM items LEFT JOIN categories ON items.category = categories.id 
WHERE items.id = ?');

$statement->execute(array($id));

$item = $statement->fetch();

function checkInput($data)
{

    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}
Database::disconnect();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Burger Code</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <h1 class="text-logo">
        <span"></span> <img src="../images/logo.png" alt=""><span></span>
    </h1>
    <div class="container admin">
        <div class="row">
            <div class="col-sm-6">
                <h1><strong>Voir un items </strong></h1>
                <br>

                <form action="">
                    <div class="form-group">
                        <label for="nom">Nom :</label><?= ' ' . $item['name']; ?>
                    </div>
                    <div class="form-group">
                        <label for="nom">Description :</label><?= ' ' . $item['description']; ?>
                    </div>
                    <div class="form-group">
                        <label for="nom">Prix :</label><?= ' ' . number_format((float)$item['price'], 2, ',', '') . ' €'; ?>
                    </div>
                    <div class="form-group">
                        <label for="nom">Categorie :</label><?= ' ' . $item['category']; ?>
                    </div>
                    <div class="form-group">
                        <label for="nom">Image :</label><?= ' ' . $item['image']; ?>
                    </div>
                </form>
                <br>
                <div class="form-actions">
                    <a href="" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left">Retour</span></a>
                </div>
            </div>

            <div class="col-md-6 site">
                <div class="img-thumbnail">
                    <img src="<?= '../images/' . $item['image'] ?>" class="img-fluid" alt="...">
                    <div class="price"> <?= number_format((float)$item['price'], 2, ',', '') . ' €'; ?> </div>
                    <div class="caption">
                        <h4><?= $item['name'] ?></h4>
                        <p><?= $item['description'] ?></p>
                        <a href="#" class="btn btn-order" role="button"><span class="bi-cart-fill"></span> Commander</a>

                    </div>
                </div>
            </div>


        </div>
    </div>

    <body>

    </body>

</html>