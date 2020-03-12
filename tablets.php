<?php
// Connect to the database
require_once('database.php');
// Set the default category to the ID of 1
if (!isset($tabletcategory_id)) {
$tabletcategory_id = filter_input(INPUT_GET, 'tabletcategory_id', 
FILTER_VALIDATE_INT);
if ($tabletcategory_id == NULL || $tabletcategory_id == FALSE) {
$tabletcategory_id = 1;
}
}
// Get name for current category
$queryTabletCategory = "SELECT * FROM tabletcategories
WHERE tabletcategoryID = :tabletcategory_id";
$statement1 = $db->prepare($queryTabletCategory);
$statement1->bindValue(':tabletcategory_id', $tabletcategory_id);
$statement1->execute();
$tabletcategory = $statement1->fetch();
$statement1->closeCursor();
$tabletcategory_name = $tabletcategory['tabletcategoryName'];
// Get all tablet categories
$queryAllTabletCategories = 'SELECT * FROM tabletcategories
ORDER BY tabletcategoryID';
$statement2 = $db->prepare($queryAllTabletCategories);
$statement2->execute();
$tabletcategories = $statement2->fetchAll();
$statement2->closeCursor();
// Get tablets for selected tablet category
$queryTablets = "SELECT * FROM tablets
WHERE tabletcategoryID = :tabletcategory_id
ORDER BY tabletID";
$statement3 = $db->prepare($queryTablets);
$statement3->bindValue(':tabletcategory_id', $tabletcategory_id);
$statement3->execute();
$tablets = $statement3->fetchAll();
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
<a class="nav-link" href="./phones.php"><img src="image-resized/black-samsung-logo.png" /></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="./phones.php">Phones <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./tablets.php">Tablets</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./wearables.php">Wearables</a>
      </li>
      <li class="nav-item dropdown">
      <a id="logout-button" href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
      </li>
    </ul>
  </div>
</nav>
</header>
<main>
<header><h1>STOCK CONTROL SYSTEM</h1></header>
<aside>
<!-- display a list of tablet categories in the sidebar-->
<h4>TABLET CATEGORIES</h4>
<nav>
<ul>
<?php foreach ($tabletcategories as $tabletcategory) : ?>
<li id="category-list"><a href="./tablets.php?tabletcategory_id=<?php echo $tabletcategory['tabletcategoryID']; ?>">
<?php echo $tabletcategory['tabletcategoryName']; ?>
</a>
</li>
<?php endforeach; ?>
</ul>
</nav>
</aside>
<section>
<!-- display a table of tablets from the database -->
<h4><?php echo $tabletcategory_name; ?></h4>
<table id="category-table">
<tr>
<th>Image</th>
<th>Code</th>
<th id="category-table-name">Name</th>
<th id="category-table-description">Description</th>
<th>Colour</th>
<th>Storage</th>
<th>Quantity in Stock</th>
<th>Price</th>
<th>Delete</th>
<th>Edit</th>
</tr>
<?php foreach ($tablets as $tablet) : ?>
<tr>
<td id="table-image"><img src="image_uploads/<?php echo $tablet['image']; ?>" width="125px" height="auto" /></td>
<td><?php echo $tablet['code']; ?></td>
<td><?php echo $tablet['name']; ?></td>
<td><?php echo $tablet['description']; ?></td>
<td><?php echo $tablet['colour']; ?></td>
<td><?php echo $tablet['storage']; ?></td>
<td><?php echo $tablet['stockQty']; ?></td>
<td><?php echo $tablet['price']; ?></td>
<td><form action="delete_tablet.php" method="post"
id="delete_tablet_form">
<input type="hidden" name="tablet_id"
value="<?php echo $tablet['tabletID']; ?>">
<input type="hidden" name="tabletcategory_id"
value="<?php echo $tablet['tabletcategoryID']; ?>">
<input type="submit" value="Delete">
</form></td>
<td><form action="edit_tablet_form.php" method="post"
id="delete_tablet_form">
<input type="hidden" name="tablet_id"
value="<?php echo $tablet['tabletID']; ?>">
<input type="hidden" name="tabletcategory_id"
value="<?php echo $tablet['tabletcategoryID']; ?>">
<input type="submit" value="Edit">
</form></td>
</tr>
<?php endforeach; ?>
</table>
<br><br>
<button id="button-actions" type="button" class="btn btn-outline-dark"><a href="add_tablet_form.php">Add tablet</a></button>
<button id="button-actions" type="button" class="btn btn-outline-dark"><a href="tablet_category_list.php">Edit tablet Categories</a></button>
</section>
</main>
<footer>
<p>&copy; <?php echo date("Y"); ?> SAMSUNG ELECTRONICS & CO, Ltd.</p>
</footer>
</body>
</html>