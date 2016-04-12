<?php

session_start();
include('includes/database.php');
$dbConnection = getDatabaseConnection('online_movie_catalogue');

function getMovieInfo() {
   global $dbConnection;
   $sql = "SELECT * 
           FROM movies
           WHERE movieId = :movieId";
   $namedParameters = array(":movieId"=>$_GET['movieId']);
   $statement =  $dbConnection->prepare($sql);
   $statement->execute($namedParameters);
   //$product = $statement->fetch(PDO::FETCH_ASSOC);
   //return $product;
   return $statement->fetch(PDO::FETCH_ASSOC);
    
}

?>

<!DOCTYPE html>
<html>
    <head>
      
         <title> Movie Database</title>
        <link rel="stylesheet" type="text/css" href="css/movieDatabase.css" />
       
    </head>
    <body>

        <?php
        
        $productInfo = getMovieInfo();
        if($productInfo != null){
        echo "Movie Description: " . $productInfo['movieDescription'];
        echo "<br>";
        echo  "Start Rating" . $productInfo['starRating'];
        echo "<br>";
        echo  "Main Actor" . $productInfo['actor'];
        
        }
        
        ?>

    </body>
</html>