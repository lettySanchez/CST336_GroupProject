<?php

session_start();



include('includes/database.php');
$dbConnection = getDatabaseConnection('online_movie_catalogue');


   
  function getItemsInCart(){
      global $dbConnection;

   // $records =  getMovies();
     $sql = "SELECT *
            FROM movies";
     
    $statement = $dbConnection->prepare($sql);
    $statement->execute();
    $records = $statement->fetchAll(PDO::FETCH_ASSOC);
     
       //  $row = 0;
       //  $records =  getMovies();
           $itemsList = $_GET["moviesToBuy"];

        $total = 0;
        echo "<table border=1>";
        echo "<td>" . "Movie Title" . "</td>" . "<td>" . "Price" . "</td>";
        echo "<tr>";
        
         if(!empty($records) && !empty($itemsList))
         {
             foreach ($records as $record) 
             {
                  foreach($itemsList as $list)
                  {
                     $movie = $record['movieTitle'];
                
                    
                     if($movie === $list){
                        
                        echo "<td> " .$list . "</td> " . "<td>" . $record['price'] . "</td>";
                        echo "<br>";
                        $total += $record['price'];
                        echo "</tr>";
                     
                 }
            }
         }
     }
     echo "</table>";
     echo "Total: " . $total;
       
   
    
  }
//print_r($itemsList);
  //header('Location: index.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Movie Database</title>
        <link rel="stylesheet" type="text/css" href="css/movieDatabase.css" />
        
    </head>
    <body>
        <h3> Thank you for shopping with us!</h3>
        
        <?php
            getItemsInCart();
        ?>
  
    </body>
</html>