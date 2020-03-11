<?php
require('database.php');
$product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
$query = 'SELECT *
          FROM products
          WHERE productID = :product_id';
$statement = $db->prepare($query);
$statement->bindValue(':product_id', $product_id);
$statement->execute();
$product = $statement->fetch(PDO::FETCH_ASSOC);
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
       <header><h1>EDIT A PRODUCT</h1></header>
        <form action="edit_product.php" method="post" enctype="multipart/form-data"
              id="add_product_form">
            <input type="hidden" name="original_image" value="<?php echo $product['image']; ?>" />
            <input type="hidden" name="product_id"
                   value="<?php echo $product['productID']; ?>">
            <label>Category ID:</label>
            <input type="category_id" name="category_id"
                   value="<?php echo $product['categoryID']; ?>">
            <br>
            <label>Code:</label>
            <input type="input" name="code"
                   value="<?php echo $product['code']; ?>">
            <br>
            <label>Name:</label>
            <input type="input" name="name"
                   value="<?php echo $product['name']; ?>">
            <br>
            <label>Description:</label>
            <input type="input" name="description"
                   value="<?php echo $product['description']; ?>">
            <br>
            <label>Colour:</label>
            <input type="input" name="colour"
                   value="<?php echo $product['colour']; ?>">
            <br>
            <label>Storage:</label>
            <input type="input" name="storage"
                   value="<?php echo $product['storage']; ?>">
              <br>
            <label>Stock Quantity:</label>
            <input type="input" name="stockQty"
                   value="<?php echo $product['stockQty']; ?>">
            <br>
            <label>Price:</label>
            <input type="input" name="price"
                   value="<?php echo $product['price']; ?>">
            <br>
            <label>Image:</label>
            <input type="file" name="image" accept="image/*" />
            <br>
            <?php if ($product['image'] != "") { ?>
            <p><img src="image_uploads/<?php echo $product['image']; ?>" height="150" /></p>
            <?php } ?>
            <label>&nbsp;</label>
            <input type="submit" value="Save Changes">
            <br>
        </form>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> SAMSUNG ELECTRONICS & CO, Ltd.</p>
    </footer>
</body>
</html>