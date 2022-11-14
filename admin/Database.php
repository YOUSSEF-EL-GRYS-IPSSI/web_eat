<?php

class Database
{

    $dbHost = "localhost";
    $dbName = "web_eat";
    $dbUser = "root";
    $userPassword = "";
    
    
    
function connect(){
      
try {
    
    $connection = new PDO("mysql:host=" . $dbHost . ";dbname=" . $dbName, $dbUser, $userPassword);
} 
catch (PDOException $e) 
{
    
    die($e->getMessage());
}

}
    




}

?>