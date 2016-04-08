<?php

    include('../../includes/database.php');
$dbConnection = getDatabaseConnection('catalogue');

function getProducts($query)
{
    global $dbConnection;
    
    $sql = "SELECT *
            FROM product
            WHERE productName LIKE '%$query%'";
   
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
    <table border=1>
        <th>TEST</th>
        
        <?php
         $records =  getProducts();
         foreach ($records as $record) 
         {
             echo "<tr>";
             echo "<td>" . $record['productName'] . "</td><td>" . $record['price']. "</td>";
             echo "</tr>";
         }
     ?>
    </table>
    </body>
</html>