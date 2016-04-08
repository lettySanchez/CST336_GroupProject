<?php
//session_start();

include('includes/database.php');
$dbConnection = getDatabaseConnection('online_movie_catalogue');

function getMovies()
{
    global $dbConnection;

            
    if(isset($_GET['searchForm']))
    {

    $sql = "SELECT *
            FROM movies";
    
    if(isset($_GET['movieQuery']))
    {
        $query = $_GET['movieQuery'];
        $sql .= " WHERE movieTitle 
                 LIKE '%$query%'";
    }
    
    if(!empty($_GET['genre']))
    {
        $genreId = $_GET['genre'];
        $sql .= " AND genreId = $genreId";
    }
    
    echo $sql;
    $statement = $dbConnection->prepare($sql);
    $statement->execute();
    $records = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $records;
    
    }

}

function getMovieGenres()
{
    global $dbConnection;
    
    $sql = "SELECT *
            FROM genres";
    $statement = $dbConnection->prepare($sql);
    $statement->execute();
    $records = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    print_r($records);
    
    return $records;
}




?>
<!DOCTYPE html>
<html>
    <head>
        <title>Online Movie Catalogue</title>
    </head>
    <body>
        <h1>Welcome to Online Movie Catalogue!</h1>
        
        
        <form>

            <select name="genre">
                <option value="">All Genres</option>
                <?php
                    $movieGenreList = getMovieGenres();
                    foreach($movieGenreList as $movieGenre)
                    {
                        echo "<option value='" . $movieGenre['genreId'] . "'>" . $movieGenre['genreName'] . "</option>";
                    }
                    
                ?>
            </select>
            
            <input type="text" name="movieQuery" placeholder="Search for a movie" size=100/>
            
            <input type="submit" value="submit" name="searchForm"/>
            
        </form>
        
        <div>
         
        <table border=1>
            
        <?php

         $row = 0;
         $records =  getMovies();
         if(!empty($records)){
         foreach ($records as $record) 
         {
             echo "<tr>";
             echo "<td>" . $record['movieTitle'] . "<br>" . $record['price']. "</td>";
             echo "</tr>";
         }
         print_r($records);
         }
         ?>
         

         </table>
        </div>
     
    </body>
</html>