<?php
    require_once('database.php');
    // Get all categories
    $query = 'SELECT * FROM phonecategories
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
<body id="body2">
<header><img src="./image-resized/black-samsung-logo.png" /></header>
    <main>
        <header><h1>PHONE CATEGORIES</h1></header>
        <br>
    <table>
        <tr>
            <th>Name</th>
            <th>&nbsp;</th>
        </tr>
        <!-- Retrieve data as an associative array and output as a foreach loop  -->
        <?php foreach ($phonecategories as $phonecategory) : ?>
        <tr>
            <td><?php echo $phonecategory['phonecategoryName']; ?></td>
            <td>
                <form action="delete_phone_category.php" method="post"
                      id="delete_phone_form">
                    <input type="hidden" name="phonecategory_id"
                           value="<?php echo $phonecategory['phonecategoryID']; ?>">
                    <input type="submit" value="Delete">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <header><h1>ADD A NEW PHONE CATEGORY</h1></header>
    <br>
    <form action="add_phone_category.php" method="post"
          id="add_phone_category_form">
        <label>Name:</label>
        <input type="input" name="name">
        <input id="add_phone_category_button" type="submit" value="Add">
    </form>
    <br>
    <button id="button-actions" type="button" class="btn btn-outline-dark"><a href="./phones.php">Return to Phones</a></button>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> SAMSUNG ELECTRONICS & CO, Ltd.</p>
    </footer>
</body>
</html>