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
<body>
    <header><img src="./image-resized/black-samsung-logo.png" /></header>

    <main>
        <header><h1>ADD A WEARABLE</h1></header>
        <form action="add_wearable.php" method="post" enctype="multipart/form-data"
              id="add_product_form">
            <label>Wearable Category:</label>
            <select name="wearablecategory_id">
            <?php foreach ($wearablecategories as $wearablecategory) : ?>
                <option value="<?php echo $wearablecategory['wearablecategoryID']; ?>">
                    <?php echo $wearablecategory['wearablecategoryName']; ?>
                </option>
            <?php endforeach; ?>
            </select>
            <br>
            <label>Code:</label>
            <input type="input" name="code" required>
            <br>

            <label>Name:</label>
            <input type="input" name="name" required>
            <br>

            <label>Description:</label>
            <input type="input" name="description">
            <br>

            <label>Colour:</label>
            <input type="input" name="colour" required>
            <br>

            <label>Size:</label required>
            <input type="input" name="size">
            <br>

            <label>Bluetooth Supported:</label>
            <input type="input" name="bluetooth">
            <br>

            <label>Stock Quantity:</label>
            <input type="input" name="stockQty" required>
            <br>

            <label>Price:</label>
            <input type="input" name="price" required>
            <br>

            <label>Image:</label>
            <input type="file" name="image" accept="image/*" />
            <br>
            <label>&nbsp;</label>
            <button type="submit" id="button-actions" type="button" class="btn btn-outline-dark">Add Wearable</button>
            <br>
        </form>
        <button id="button-actions" type="button" class="btn btn-outline-dark"><a href="index.php">Homepage</a></button>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> SAMSUNG ELECTRONICS & CO, Ltd.</p>
    </footer>
</body>
</html>