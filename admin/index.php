<?php

include_once('../include/header.php');

?>
<h1 class="text-logo">
  <span"></span> <img src="images/logo.png" alt=""><span></span>
</h1>

<div class="container admin">
  <div class="row">
    <h1><strong>Liste des items </strong><a href="insert.php" class="btn btn-success btn-lg"><span class="bi-plus"></span> Ajouter</a></h1>
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Nom</th>
          <th>Description</th>
          <th>Prix</th>
          <th>Catégorie</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php

        require_once 'Database.php';

        $db = Database::connect();

        $statement = $db->prepare('SELECT items.id, items.name, items.description, items.price, categories.name AS category 
          FROM items LEFT JOIN categories ON items.category = categories.id ORDER BY id DESC');
        $statement->execute();
        $result = $statement->fetchAll();


        foreach ($result as $item) {

          // echo ' <pre>';
          // print_r($item);
          // echo ' </pre>';
          echo ' <tr>';
          echo ' <td>' . $item['name'] . '</td>';
          echo '<td>' . $item['description'] . '</td>';
          echo '<td>' . number_format((float)$item['price'], 2, ',', '') . '</td>';
          echo ' <td>' . $item['category'] . '</td>';
          echo '<td width=340>';
          echo '  <a class="btn btn-secondary" href="view.php?id=' . $item['id'] . '"><span class="bi-eye"></span> Voir</a>';
          echo ' <a class="btn btn-primary" href="update.php?id=' . $item['id'] . '"><span class="bi-pencil"></span> Modifier</a>';
          echo ' <a class="btn btn-danger" href="delete.php?id=' . $item['id'] . '"><span class="bi-x"></span> Supprimer</a>';
          echo '</td>';
          echo '</tr>';
        }



        Database::disconnect();
        ?>


      </tbody>
    </table>
  </div>
</div>


<?php include_once('../include/header.php'); ?>