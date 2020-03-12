<?php
require('database.php');
$tablet_id = filter_input(INPUT_POST, 'tablet_id', FILTER_VALIDATE_INT);
$query = 'SELECT *
          FROM tablets
          WHERE tabletID = :tablet_id';
$statement = $db->prepare($query);
$statement->bindValue(':tablet_id', $tablet_id);
$statement->execute();
$tablet = $statement->fetch(PDO::FETCH_ASSOC);
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
       <header><h1>EDIT A TABLET</h1></header>
        <form action="edit_tablet.php" method="post" enctype="multipart/form-data"
              id="add_product_form">
            <input type="hidden" name="original_image" value="<?php echo $tablet['image']; ?>" />
            <input type="hidden" name="tablet_id"
                   value="<?php echo $tablet['tabletID']; ?>">
            <label>Tablet Category ID:</label>
            <input type="tabletcategory_id" name="tabletcategory_id"
                   value="<?php echo $tablet['tabletcategoryID']; ?>">
            <br>
            <label>Code:</label>
            <input type="input" name="code" required
                   value="<?php echo $tablet['code']; ?>">
            <br>
            <label>Name:</label>
            <input type="input" name="name" required
                   value="<?php echo $tablet['name']; ?>">
            <br>
            <label>Description:</label>
            <input type="input" name="description"
                   value="<?php echo $tablet['description']; ?>">
            <br>
            <label>Colour:</label>
            <input type="input" name="colour" required
                   value="<?php echo $tablet['colour']; ?>">
            <br>
            <label>Storage:</label>
            <input type="input" name="storage" required pattern="[0-9]+[A-Z].{1,}" title="Must contan at least one number followed by two letters (such as 128GB or 1TB)"
                   value="<?php echo $tablet['storage']; ?>">
              <br>
            <label>Stock Quantity:</label>
            <input type="input" name="stockQty" required
                   value="<?php echo $tablet['stockQty']; ?>">
            <br>
            <label>Price:</label>
            <input type="input" name="price" required
                   value="<?php echo $tablet['price']; ?>">
            <br>
            <label>Image:</label>
            <input type="file" name="image" accept="image/*" />
            <br>
            <?php if ($tablet['image'] != "") { ?>
            <p><img src="image_uploads/<?php echo $tablet['image']; ?>" height="150" /></p>
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