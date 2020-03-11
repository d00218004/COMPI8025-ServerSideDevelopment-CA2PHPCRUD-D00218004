<?php
// Connect to the database
require_once('database.php');
// Set the default category to the ID of 1
if (!isset($category_id)) {
$category_id = filter_input(INPUT_GET, 'category_id', 
FILTER_VALIDATE_INT);
if ($category_id == NULL || $category_id == FALSE) {
$category_id = 6;
}
}
// Get name for current category
$queryCategory = "SELECT * FROM categories
WHERE categoryID = :category_id";
$statement1 = $db->prepare($queryCategory);
$statement1->bindValue(':category_id', $category_id);
$statement1->execute();
$category = $statement1->fetch();
$statement1->closeCursor();
$category_name = $category['categoryName'];
// Get all categories
$queryAllCategories = 'SELECT * FROM categories
ORDER BY categoryID';
$statement2 = $db->prepare($queryAllCategories);
$statement2->execute();
$categories = $statement2->fetchAll();
$statement2->closeCursor();
// Get wearables for selected category
$queryWearables = "SELECT * FROM wearables
WHERE categoryID = :category_id
ORDER BY wearableID";
$statement3 = $db->prepare($queryWearables);
$statement3->bindValue(':category_id', $category_id);
$statement3->execute();
$wearables = $statement3->fetchAll();
$statement3->closeCursor();
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
<header>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
<img href="../../../" src="image-resized/black-samsung-logo.png" />
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="../COMPI8025-ServerSideDevelopment-CA2PHPCRUD-D00218004/">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Features</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Pricing</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown link
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
    </ul>
  </div>
</nav></header>
<main>
<header><h1>STOCK CONTROL SYSTEM</h1></header>
<aside>
<!-- display a list of categories in the sidebar-->
<h4>CATEGORIES</h4>
<nav>
<ul>
<?php foreach ($categories as $category) : ?>
<li id="category-list"><a href=".?category_id=<?php echo $category['categoryID']; ?>">
<?php echo $category['categoryName']; ?>
</a>
</li>
<?php endforeach; ?>
</ul>
</nav>
</aside>
<section>
<!-- display a table of wearables from the database -->
<h4><?php echo $category_name; ?></h4>
<table id="category-table">
<tr>
<th>Image</th>
<th>Code</th>
<th id="category-table-name">Name</th>
<th id="category-table-description">Description</th>
<th>Colour</th>
<th>Wattage</th>
<th>Quantity in Stock</th>
<th>Price</th>
<th>Delete</th>
<th>Edit</th>
</tr>
<?php foreach ($wearables as $wearable) : ?>
<tr>
<td id="table-image"><img src="image_uploads/<?php echo $wearable['image']; ?>" width="125px" height="auto" /></td>
<td><?php echo $wearable['code']; ?></td>
<td><?php echo $wearable['name']; ?></td>
<td><?php echo $wearable['description']; ?></td>
<td><?php echo $wearable['colour']; ?></td>
<td><?php echo $wearable['wattage']; ?></td>
<td><?php echo $wearable['stockQty']; ?></td>
<td><?php echo $wearable['price']; ?></td>
<td><form action="delete_wearable.php" method="post"
id="delete_wearable_form">
<input type="hidden" name="wearable_id"
value="<?php echo $wearable['wearableID']; ?>">
<input type="hidden" name="category_id"
value="<?php echo $wearable['categoryID']; ?>">
<input type="submit" value="Delete">
</form></td>
<td><form action="edit_wearable_form.php" method="post"
id="delete_wearable_form">
<input type="hidden" name="wearable_id"
value="<?php echo $wearble['wearableID']; ?>">
<input type="hidden" name="category_id"
value="<?php echo $wearable['categoryID']; ?>">
<input type="submit" value="Edit">
</form></td>
</tr>
<?php endforeach; ?>
</table>
<br><br>
<button id="button-actions" type="button" class="btn btn-outline-dark"><a href="add_wearable_form.php">Add Wearable</a></button>
<button id="button-actions" type="button" class="btn btn-outline-dark"><a href="category_list.php">Edit Categories</a></button>
</section>
</main>
<footer>
<p>&copy; <?php echo date("Y"); ?> SAMSUNG ELECTRONICS & CO, Ltd.</p>
</footer>
</body>
</html>