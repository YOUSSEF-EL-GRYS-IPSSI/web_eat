<?php
require_once 'Database.php';

if (!empty($_GET['id'])) {

    $id = checkInput($_GET['id']);
    //print_r($id);
} 
if(!empty($_POST)){

    $id = checkInput($_POST['id']);
    
    $db = Database::connect();
    $statement = $db->prepare('DELETE From items WHERE id = ?');
    $statement->execute(array($id));

    print_r($statement);
    
    Database::disconnect();
    header('location: index.php');
}
// else {
//     header('location: ../index.php');
// }


function checkInput($data)
{

    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}
?>


<?php include_once('../include/header.php');?>

    <h1 class="text-logo">
        <span"></span> <img src="../images/logo.png" alt=""><span></span>
    </h1>
    <div class="container admin">
        <div class="row">

            <h1><strong>Supprimer un items </strong></h1>
            <br>

            <form class="form" role="form" action="delete.php" method="POST">
                <input type="hidden" name="id" id="id" value="<?= $id ?>">
                <p class="alert alert-warning">Êtes vous sur de vouloir supprimer ?</p>
                <div class="form-actions">
                    <button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-arrow-left">Oui</span></button>
                    <a href="index.php" class="btn btn-outline-dark">Non</a>
                </div>
            </form>
            <br>





        </div>
    </div>

 
    <?php include_once('../include/header.php'); ?>