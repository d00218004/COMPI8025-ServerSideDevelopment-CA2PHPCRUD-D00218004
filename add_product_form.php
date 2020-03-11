<?php
require('database.php');
$query = 'SELECT *
          FROM categories
          ORDER BY categoryID';
$statement = $db->prepare($query);
$statement->execute();
$categories = $statement->fetchAll();
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
        <header><h1>ADD A PRODUCT</h1></header>
        <form action="add_product.php" method="post" enctype="multipart/form-data"
              id="add_product_form">
            <label>Category:</label>
            <select name="category_id">
            <?php foreach ($categories as $category) : ?>
                <option value="<?php echo $category['categoryID']; ?>">
                    <?php echo $category['categoryName']; ?>
                </option>
            <?php endforeach; ?>
            </select>
            <br>
            <label>Code:</label>
            <input type="input" name="code">
            <br>

            <label>Name:</label>
            <input type="input" name="name">
            <br>

            <label>Description:</label>
            <input type="input" name="description">
            <br>

            <label>Colour:</label>
            <input type="input" name="colour">
            <br>

            <label>Storage:</label>
            <input type="input" name="storage">
            <br>

            <label>Stock Quantity:</label>
            <input type="input" name="stockQty">
            <br>

            <label>Price:</label>
            <input type="input" name="price">
            <br>

            <label>Image:</label>
            <input type="file" name="image" accept="image/*" />
            <br>
            <label>&nbsp;</label>
            <button type="submit" id="button-actions" type="button" class="btn btn-outline-dark">Add Product</button>
            <br>
        </form>
        <button id="button-actions" type="button" class="btn btn-outline-dark"><a href="index.php">Homepage</a></button>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> SAMSUNG ELECTRONICS & CO, Ltd.</p>
    </footer>
</body>
</html>