<?php
require('database.php');
$query = 'SELECT *
          FROM wearablecategories
          ORDER BY wearablecategoryID';
$statement = $db->prepare($query);
$statement->execute();
$wearablecategories = $statement->fetchAll();
$statement->closeCursor();
?>
<!DOCTYPE html>
<html>
<!-- the head section -->
<head>
    <title>SAMSUNG ELECTRONICS</title>
    <link rel="stylesheet" type="text/css" href="./scss/main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<!-- the body section -->
<body id="body2">
    <header><img src="./image-resized/black-samsung-logo.png" /></header>

    <main>
        <header><h1>ADD A WEARABLE</h1></header>
        <form action="add_wearable.php" method="post" enctype="multipart/form-data"
              id="add_product_form">
            <label>Wearable Category:</label>

            <select class="form-control" name="wearablecategory_id">
            <?php foreach ($wearablecategories as $wearablecategory) : ?>
                <option value="<?php echo $wearablecategory['wearablecategoryID']; ?>">
                    <?php echo $wearablecategory['wearablecategoryName']; ?>
                </option>
            <?php endforeach; ?>
            </select>
            <br>
            <label>Code:</label>
            <input class="form-control" type="input" name="code" required placeholder="Product must have a Stock Code">
            <br>

            <label>Name:</label>
            <input class="form-control" type="input" name="name" required placeholder="Product must have a Stock Name">
            <br>

            <label>Description:</label>
            <input class="form-control" type="input" name="description">
            <br>

            <label>Colour:</label>
            <input class="form-control" type="input" name="colour" required placeholder="Product must have a Colour">
            <br>

            <label>Size:</label required>
            <input class="form-control" type="input" name="size" placeholder="Product must have a Size">
            <br>

            <label>Bluetooth Supported:</label>
            <input class="form-control" type="input" name="bluetooth">
            <br>

            <label>Stock Quantity:</label>
            <input class="form-control" type="input" name="stockQty" required placeholder="Product must have a Quantity">
            <br>

            <label>Price:</label>
            <input class="form-control" type="input" name="price" required placeholder="Product must have a Price">
            <br>

            <label>Image:</label>
            <input type="file" name="image" accept="image/*" />
            <br>
            <label>&nbsp;</label>
            <button type="submit" id="button-actions" type="button" class="btn btn-outline-dark">Add Wearable</button>
            <br>
        </form>
        <button id="button-actions" type="button" class="btn btn-outline-dark"><a href="./wearables.php">Return to Wearables</a></button>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> SAMSUNG ELECTRONICS & CO, Ltd.</p>
    </footer>
</body>
</html>