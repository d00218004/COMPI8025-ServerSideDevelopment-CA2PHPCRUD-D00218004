<?php
// Connect to the database
require_once('database.php');
// Set the default category to the ID of 1
if (!isset($wearablecategory_id)) {
$wearablecategory_id = filter_input(INPUT_GET, 'wearablecategory_id', 
FILTER_VALIDATE_INT);
if ($wearablecategory_id == NULL || $wearablecategory_id == FALSE) {
$wearablecategory_id = 1;
}
}
// Get name for current category
$queryWearableCategory = "SELECT * FROM wearablecategories
WHERE wearablecategoryID = :wearablecategory_id";
$statement1 = $db->prepare($queryWearableCategory);
$statement1->bindValue(':wearablecategory_id', $wearablecategory_id);
$statement1->execute();
$wearablecategory = $statement1->fetch();
$statement1->closeCursor();
$wearablecategory_name = $wearablecategory['wearablecategoryName'];
// Get all wearable categories
$queryAllWearableCategories = 'SELECT * FROM wearablecategories
ORDER BY wearablecategoryID';
$statement2 = $db->prepare($queryAllWearableCategories);
$statement2->execute();
$wearablecategories = $statement2->fetchAll();
$statement2->closeCursor();
// Get wearables for selected wearable category
$queryWearables = "SELECT * FROM wearables
WHERE wearablecategoryID = :wearablecategory_id
ORDER BY wearableID";
$statement3 = $db->prepare($queryWearables);
$statement3->bindValue(':wearablecategory_id', $wearablecategory_id);
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
        <a class="nav-link" href="../COMPI8025-ServerSideDevelopment-CA2PHPCRUD-D00218004/?tabletcategory_id=1">Phones <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./tablets.php">Tablets</a>
      </li>
      <li class="nav-item">
      <a class="nav-link" href="./wearables.php">Wearables</a>
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
<!-- display a list of wearable categories in the sidebar-->
<h4>WEARABLE CATEGORIES</h4>
<nav>
<ul>
<?php foreach ($wearablecategories as $wearablecategory) : ?>
<li id="category-list"><a href="./wearables.php.?wearablecategory_id=<?php echo $wearablecategory['wearablecategoryID']; ?>">
<?php echo $wearablecategory['wearablecategoryName']; ?>
</a>
</li>
<?php endforeach; ?>
</ul>
</nav>
</aside>
<section>
<!-- display a table of wearables from the database -->
<h4><?php echo $wearablecategory_name; ?></h4>
<table id="wearable-category-table">
<tr>
<th>Image</th>
<th>Code</th>
<th id="wearable-category-table-name">Name</th>
<th id="wearable-category-table-description">Description</th>
<th>Colour</th>
<th>Size</th>
<th>Bluetooth Support</th>
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
<td><?php echo $wearable['size']; ?></td>
<td><?php echo $wearable['bluetooth']; ?></td>
<td><?php echo $wearable['stockQty']; ?></td>
<td><?php echo $wearable['price']; ?></td>
<td><form action="delete_wearable.php" method="post"
id="delete_wearable_form">
<input type="hidden" name="wearable_id"
value="<?php echo $wearable['wearableID']; ?>">
<input type="hidden" name="wearablecategory_id"
value="<?php echo $wearable['wearablecategoryID']; ?>">
<input type="submit" value="Delete">
</form></td>
<td><form action="edit_wearable_form.php" method="post"
id="delete_wearable_form">
<input type="hidden" name="wearable_id"
value="<?php echo $wearable['wearableID']; ?>">
<input type="hidden" name="wearablecategory_id"
value="<?php echo $wearable['wearablecategoryID']; ?>">
<input type="submit" value="Edit">
</form></td>
</tr>
<?php endforeach; ?>
</table>
<br><br>
<button id="button-actions" type="button" class="btn btn-outline-dark"><a href="add_wearable_form.php">Add wearable</a></button>
<button id="button-actions" type="button" class="btn btn-outline-dark"><a href="wearable_category_list.php">Edit wearable Categories</a></button>
</section>
</main>
<footer>
<p>&copy; <?php echo date("Y"); ?> SAMSUNG ELECTRONICS & CO, Ltd.</p>
</footer>
</body>
</html>