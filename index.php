<?php
/*
include('/team_project/CST336_GroupProject/includes/database.php');
$dbConnection = getDatabaseConnection('catalogue');

function getProductTypes()
{
     global $dbConnection;
    
    $sql = "SELECT *
            FROM productType";
    $statement = $dbConnection->prepare($sql);
    $statement->execute();
    $records = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    //print_r($records);
    
    return $records;
}

function getItems()
{
    //array
    global $dbConnection;
    
    $sql = "SELECT *
            FROM products";
    $statement = $dbConnection->prepare($sql);
    $statement->execute();
    $records = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    //print_r($records);
    
    return $records;

}
*/

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Online Catalogue</title>
    </head>
    <body>
        <h1>Welcome to Online Catalogue!</h1>
        
        <form>

            <select name="category">
                <option value="All">All</option>
                <?php/*
                    $productTypeList = getProductTypes();
                    foreach($productTypeList as $productType)
                    {
                        echo "<option value='$productType'>$productType</option>";
                    }*/
                    
                ?>
            </select>
            <input type="text" name="searchItem" placeholder="Search for an item" size=100/>
            <a target="productsFrame" href="getProducts.php"><input type="submit" value="submit" name="search"/></a>
            
        </form>
        
        
        <div>
            <iframe name= "productsFrame" width="900" height="900" src="getProducts.php" frameborder="1"></iframe>
        </div>
     
    </body>
</html>