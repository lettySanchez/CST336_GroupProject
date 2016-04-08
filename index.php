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
    
    if(isset($_GET['starRating']))
    {
        $starRating = $_GET['starRating'];
        $sql .= " AND starRating = $starRating";
    }
    if(isset($_GET['priceRange']))
    {
        $priceStartRange = $_GET['priceRange'];
        $priceEndRange = $priceStartRange + 3;
        $starRating = $_GET['priceRange'];
        $sql .= " AND price >= $priceStartRange AND price <= $priceEndRange";
    }
    if(isset($_GET['sortBy']))
    {
        
        $order = $_GET['sortBy'];
        if($order == "high")
            $sql .= " ORDER BY price DESC";
        else if($order == "low")
            $sql .= " ORDER BY price";
    }
    
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
            
            <br>
           <strong>Star Rating</strong><br>
            <input type='radio' name='starRating' value='1' id='1'>
                  <label for='1'>1</label>
            <input type='radio' name='starRating' value='2' id='2'>
                  <label for='2'>2</label>
            <input type='radio' name='starRating' value='3' id='3'>
                  <label for='3'>3</label>
            <input type='radio' name='starRating' value='4' id='4'>
                  <label for='4'>4</label>
            <input type='radio' name='starRating' value='5' id='5'>
                  <label for='5'>5</label>
            <br>
            <strong>Price Range</strong>
                  
            <input type='radio' name='priceRange' value='1' id='1'>
                  <label for='1'>$1-$4</label>
            <input type='radio' name='priceRange' value='5' id='5'>
                  <label for='5'>$5-$9</label>
            <input type='radio' name='priceRange' value='10' id='10'>
                  <label for='10'>$10-$14</label>
            
            <br>
            <strong>Sort by</strong>
            <select name="sortBy">
                <option value="">Select</option>
                <option value="low">Price: Low to High</option>
                <option value ="high">Price: High to Low</option>
            </select>

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
             echo "<td>" . $record['movieTitle'] . "<br>" . $record['price']. "<br>
                  <button type='button'>Add to Cart</button></td>";
             echo "</tr>";
         }
         print_r($records);
         }
         ?>
         

         </table>
        </div>
     
    </body>
</html>