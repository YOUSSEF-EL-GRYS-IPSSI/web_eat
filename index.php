<?php require_once('include/header.php'); ?>

<div class="container site">

    <h1 class="text-logo"><span></span><img src="images/logo.png" alt=""><span></span></h1>


    <?php

    require 'admin/Database.php';

    echo '<nav>
              <ul class="nav nav-pills" role="tablist">';

    $db = Database::connect();

    //    $statement = $db->prepare('SELECT * FROM categories');
    //    $statement->execute();
    //    $categorie = $statement->fetchAll();

    $statement = $db->query('SELECT * FROM categories');
    $categories = $statement->fetchAll();


    foreach ($categories as $categorie) {

        if ($categorie['id'] == 1)

            echo  '<li class="nav-item" role="presentation"> <a href="#tab' . $categorie['id'] . '" class="nav-link active" data-bs-toggle="pill" data-bs-target="#tab' . $categorie['id'] . '" role="tab' . $categorie['id'] . '">' . $categorie['name'] . '</a> </li>';
        else
            echo  '<li class="nav-item" role="presentation"> <a href="#tab' . $categorie['id'] . '" class="nav-link" data-bs-toggle="pill" data-bs-target="#tab' . $categorie['id'] . '" role="tab' . $categorie['id'] . '">' . $categorie['name'] . '</a> </li>';
    }


    echo '   </ul>
         </nav>';

    echo '<div class="tab-content">';



    foreach ($categories as $categorie) {

        if ($categorie['id'] == 1)

            echo  '<div class="tab-pane active" id="tab' . $categorie['id'] . '" role="tabpane' . $categorie['id'] . '">';
        else
            echo '<div class="tab-pane" id="tab' . $categorie['id'] . '" role="tabpane' . $categorie['id'] . '">';

        echo  ' <div class="row">';

        $statement = $db->prepare('SELECT * FROM items WHERE items.category = ?');

        $statement->execute(array($categorie['id']));

        while ($item = $statement->fetch()) {
            echo '<div class="col-md-6 col-lg-4">
                    <div class="img-thumbnail">
                        <img src="images/' . $item['image'] . '" class="img-fluid" alt="...">
                        <div class="price">' . $item['price'] . ' €</div>
                        <div class="caption">
                            <h4>' . $item['name'] . '</h4>
                            <p>' . $item['description'] . '</p>
                            <a href="#" class="btn btn-order" role="button"><span class="bi-cart-fill"></span> Commander</a>
                        </div>
                    </div>
                </div>';
        }

        echo '</div>
        </div>';
    }
    echo '</div>';

    Database::disconnect();
    ?>





</div>





<?php require_once('include/footer.php'); ?>