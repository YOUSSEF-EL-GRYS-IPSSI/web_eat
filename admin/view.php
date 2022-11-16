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


<?php include_once('../include/header.php');?>

<body>
    <h1 class="text-logo">
        <span"></span> <img src="../images/logo.png" alt=""><span></span>
    </h1>
    <div class="container admin">
        <div class="row">
            <div class="col-sm-6">
                <h1><strong>Voir un items </strong></h1>
                <br>

                <form>
                    <div>
                        <label>Nom:</label><?php echo '  ' . $item['name']; ?>
                    </div>
                    <br>
                    <div>
                        <label>Description:</label><?php echo '  ' . $item['description']; ?>
                    </div>
                    <br>
                    <div>
                        <label>Prix:</label><?php echo '  ' . number_format((float)$item['price'], 2, '.', '') . ' €'; ?>
                    </div>
                    <br>
                    <div>
                        <label>Catégorie:</label><?php echo '  ' . $item['category']; ?>
                    </div>
                    <br>
                    <div>
                        <label>Image:</label><?php echo '  ' . $item['image']; ?>
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

  
 <?php include_once('../include/header.php'); ?>