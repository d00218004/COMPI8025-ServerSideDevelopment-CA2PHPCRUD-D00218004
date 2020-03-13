<?php
require('database.php');
$wearable_id = filter_input(INPUT_POST, 'wearable_id', FILTER_VALIDATE_INT);
$query = 'SELECT *
          FROM wearables
          WHERE wearableID = :wearable_id';
$statement = $db->prepare($query);
$statement->bindValue(':wearable_id', $wearable_id);
$statement->execute();
$wearable = $statement->fetch(PDO::FETCH_ASSOC);
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
       <header><h1>EDIT A WEARABLE</h1></header>
        <form action="edit_wearable.php" method="post" enctype="multipart/form-data"
              id="add_product_form">
            <input type="hidden" name="original_image" value="<?php echo $wearable['image']; ?>" />
            <input type="hidden" name="wearable_id"
                   value="<?php echo $wearable['wearableID']; ?>">
            <label>Wearable Category ID:</label>
            <input type="wearablecategory_id" name="wearablecategory_id"
                   value="<?php echo $wearable['wearablecategoryID']; ?>">
            <br>
            <label>Code:</label>
            <input type="input" name="code" required
                   value="<?php echo $wearable['code']; ?>">
            <br>
            <label>Name:</label>
            <input type="input" name="name" required
                   value="<?php echo $wearable['name']; ?>">
            <br>
            <label>Description:</label>
            <input type="input" name="description"
                   value="<?php echo $wearable['description']; ?>">
            <br>
            <label>Colour:</label>
            <input type="input" name="colour" required
                   value="<?php echo $wearable['colour']; ?>">
            <br>
            <label>Size:</label>
            <input type="input" name="size"
                   value="<?php echo $wearable['size']; ?>">
              <br>
            <label>Bluetooth:</label>
            <input type="input" name="bluetooth"
                   value="<?php echo $wearable['bluetooth']; ?>">
              <br>
            <label>Stock Quantity:</label>
            <input type="input" name="stockQty" required
                   value="<?php echo $wearable['stockQty']; ?>">
            <br>
            <label>Price:</label>
            <input type="input" name="price" required
                   value="<?php echo $wearable['price']; ?>">
            <br>
            <label>Image:</label>
            <input type="file" name="image" accept="image/*" />
            <br>
            <?php if ($wearable['image'] != "") { ?>
            <p><img src="image_uploads/<?php echo $wearable['image']; ?>" height="150" /></p>
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