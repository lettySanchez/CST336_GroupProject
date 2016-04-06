<?php

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
            <input type="submit" value="submit" name="search">
        </form>

    </body>
</html>