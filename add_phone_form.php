<?php
require('database.php');
$query = 'SELECT *
          FROM phonecategories
          ORDER BY phonecategoryID';
$statement = $db->prepare($query);
$statement->execute();
$phonecategories = $statement->fetchAll();
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
        <header><h1>ADD A PHONE</h1></header>
        <form action="add_phone.php" method="post" enctype="multipart/form-data"
              id="add_product_form">
            <label>Phone Category:</label>
            <select name="phonecategory_id">
            <?php foreach ($phonecategories as $phonecategory) : ?>
                <option value="<?php echo $phonecategory['phonecategoryID']; ?>">
                    <?php echo $phonecategory['phonecategoryName']; ?>
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

            <label>Storage:</label required>
            <input type="input" name="storage" pattern="[0-9]+[A-Z].{1,}" title="Must contan at least one number followed by two letters (such as 128GB or 1TB)">
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
            <button type="submit" id="button-actions" type="button" class="btn btn-outline-dark">Add Phone</button>
            <br>
        </form>
        <button id="button-actions" type="button" class="btn btn-outline-dark"><a href="phones.php">Return to Phones</a></button>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> SAMSUNG ELECTRONICS & CO, Ltd.</p>
    </footer>
</body>
</html>