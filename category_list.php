<?php
    require_once('database.php');
    // Get all categories
    $query = 'SELECT * FROM categories
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
        <header><h1>CATEGORIES</h1></header>
        <br>
    <table>
        <tr>
            <th>Name</th>
            <th>&nbsp;</th>
        </tr>
        <!-- Retrieve data as an associative array and output as a foreach loop  -->
        <?php foreach ($categories as $category) : ?>
        <tr>
            <td><?php echo $category['categoryName']; ?></td>
            <td>
                <form action="delete_category.php" method="post"
                      id="delete_product_form">
                    <input type="hidden" name="category_id"
                           value="<?php echo $category['categoryID']; ?>">
                    <input type="submit" value="Delete">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <header><h1>ADD A NEW CATEGORY</h1></header>
    <br>
    <form action="add_category.php" method="post"
          id="add_category_form">
        <label>Name:</label>
        <input type="input" name="name">
        <input id="add_category_button" type="submit" value="Add">
    </form>
    <br>
    <button id="button-actions" type="button" class="btn btn-outline-dark"><a href="index.php">Homepage</a></button>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> SAMSUNG ELECTRONICS & CO, Ltd.</p>
    </footer>
</body>
</html>