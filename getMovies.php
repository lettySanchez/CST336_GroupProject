<?php
session_start();

include('includes/database.php');
$dbConnection = getDatabaseConnection('online_movie_catalogue');

function getMovies()
{
    global $dbConnection;
    
    $sql = "SELECT *
            FROM movies";
    
    if(isset($_GET['movieQuery']))
    {
        $query = $_GET['movieQuery'];
        $sql .= " WHERE movieTitle 
                 LIKE '%$query%'";
    }
    
    if(isset($_GET['genre']))
    {
        
        echo "TEST" . $_GET['genre'];
        $genreId = $_GET['genre'];
        $sql .= " AND genreId = $genreId";
    }
    
   
    $statement = $dbConnection->prepare($sql);
    $statement->execute();
    $records = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    return $records;
    
}


?>
<!DOCTYPE html>
<html>
    <head>
        <title> </title>
    </head>
    <body>
        <th>TEST</th>
        
         
        <table border=1>
            
        <?php
        echo "GENRE " . $_GET['genre'];
        echo "MOVIE QUERY " . $_GET['movieQuery'];
         $row = 0;
         $records =  getMovies();
         foreach ($records as $record) 
         {
             echo "<tr>";
             echo "<td>" . $record['movieTitle'] . "<br>" . $record['price']. "</td>";
             echo "</tr>";
         }
         print_r($records);
         ?>
         

         </table>
    </body>
</html>

