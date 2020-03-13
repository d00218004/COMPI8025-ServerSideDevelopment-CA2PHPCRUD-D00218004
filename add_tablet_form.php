<?php
require('database.php');
$query = 'SELECT *
          FROM tabletcategories
          ORDER BY tabletcategoryID';
$statement = $db->prepare($query);
$statement->execute();
$tabletcategories = $statement->fetchAll();
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
        <header><h1>ADD A TABLET</h1></header>
        <form action="add_tablet.php" method="post" enctype="multipart/form-data"
              id="add_product_form">
            <label>Tablet Category:</label>
            <select name="tabletcategory_id">
            <?php foreach ($tabletcategories as $tabletcategory) : ?>
                <option value="<?php echo $tabletcategory['tabletcategoryID']; ?>">
                    <?php echo $tabletcategory['tabletcategoryName']; ?>
                </option>
            <?php endforeach; ?>
            </select>
            <br>
            <label>Code:</label>
            <input type="input" name="code" required placeholder="Product must have a Stock Code">
            <br>

            <label>Name:</label>
            <input type="input" name="name" required placeholder="Product must have a Name">
            <br>

            <label>Description:</label>
            <input type="input" name="description">
            <br>

            <label>Colour:</label>
            <input type="input" name="colour" required placeholder="Product must have a Colour">
            <br>

            <label>Storage:</label required>
            <input type="input" name="storage" pattern="[0-9]+[A-Z].{1,}" title="Must contan at least one number followed by two letters (such as 128GB or 1TB)">
            <br>

            <label>Stock Quantity:</label>
            <input type="input" name="stockQty" required placeholder="Product must have a Quantity">
            <br>

            <label>Price:</label>
            <input type="input" name="price" required placeholder="Product must have a Price">
            <br>

            <label>Image:</label>
            <input type="file" name="image" accept="image/*" />
            <br>
            <label>&nbsp;</label>
            <button type="submit" id="button-actions" type="button" class="btn btn-outline-dark">Add Tablet</button>
            <br>
        </form>
        <button id="button-actions" type="button" class="btn btn-outline-dark"><a href="tablets.php">Return to Tablets</a></button>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> SAMSUNG ELECTRONICS & CO, Ltd.</p>
    </footer>
</body>
</html>