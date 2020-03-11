<?php
// Connect to the database
require_once('database.php');
// Set the default category to the ID of 1
if (!isset($phonecategory_id)) {
$phonecategory_id = filter_input(INPUT_GET, 'phonecategory_id', 
FILTER_VALIDATE_INT);
if ($phonecategory_id == NULL || $phonecategory_id == FALSE) {
$phonecategory_id = 1;
}
}
// Get name for current category
$queryPhoneCategory = "SELECT * FROM phonecategories
WHERE phonecategoryID = :phonecategory_id";
$statement1 = $db->prepare($queryPhoneCategory);
$statement1->bindValue(':phonecategory_id', $phonecategory_id);
$statement1->execute();
$phonecategory = $statement1->fetch();
$statement1->closeCursor();
$phonecategory_name = $phonecategory['phonecategoryName'];
// Get all phone categories
$queryAllPhoneCategories = 'SELECT * FROM phonecategories
ORDER BY phonecategoryID';
$statement2 = $db->prepare($queryAllPhoneCategories);
$statement2->execute();
$phonecategories = $statement2->fetchAll();
$statement2->closeCursor();
// Get phones for selected phone category
$queryPhones = "SELECT * FROM phones
WHERE phonecategoryID = :phonecategory_id
ORDER BY phoneID";
$statement3 = $db->prepare($queryPhones);
$statement3->bindValue(':phonecategory_id', $phonecategory_id);
$statement3->execute();
$phones = $statement3->fetchAll();
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
        <a class="nav-link" href="../COMPI8025-ServerSideDevelopment-CA2PHPCRUD-D00218004/?phonecategory_id=1">Home <span class="sr-only">(current)</span></a>
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
<!-- display a list of phone categories in the sidebar-->
<h4>PHONE CATEGORIES</h4>
<nav>
<ul>
<?php foreach ($phonecategories as $phonecategory) : ?>
<li id="category-list"><a href=".?phonecategory_id=<?php echo $phonecategory['phonecategoryID']; ?>">
<?php echo $phonecategory['phonecategoryName']; ?>
</a>
</li>
<?php endforeach; ?>
</ul>
</nav>
</aside>
<section>
<!-- display a table of phones from the database -->
<h4><?php echo $phonecategory_name; ?></h4>
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
<?php foreach ($phones as $phone) : ?>
<tr>
<td id="table-image"><img src="image_uploads/<?php echo $phone['image']; ?>" width="125px" height="auto" /></td>
<td><?php echo $phone['code']; ?></td>
<td><?php echo $phone['name']; ?></td>
<td><?php echo $phone['description']; ?></td>
<td><?php echo $phone['colour']; ?></td>
<td><?php echo $phone['storage']; ?></td>
<td><?php echo $phone['stockQty']; ?></td>
<td><?php echo $phone['price']; ?></td>
<td><form action="delete_phone.php" method="post"
id="delete_phone_form">
<input type="hidden" name="phone_id"
value="<?php echo $phone['phoneID']; ?>">
<input type="hidden" name="phonecategory_id"
value="<?php echo $phone['phonecategoryID']; ?>">
<input type="submit" value="Delete">
</form></td>
<td><form action="edit_phone_form.php" method="post"
id="delete_phone_form">
<input type="hidden" name="phone_id"
value="<?php echo $phone['phoneID']; ?>">
<input type="hidden" name="phonecategory_id"
value="<?php echo $phone['phonecategoryID']; ?>">
<input type="submit" value="Edit">
</form></td>
</tr>
<?php endforeach; ?>
</table>
<br><br>
<button id="button-actions" type="button" class="btn btn-outline-dark"><a href="add_phone_form.php">Add Phone</a></button>
<button id="button-actions" type="button" class="btn btn-outline-dark"><a href="phone_category_list.php">Edit Phone Categories</a></button>
</section>
</main>
<footer>
<p>&copy; <?php echo date("Y"); ?> SAMSUNG ELECTRONICS & CO, Ltd.</p>
</footer>
</body>
</html>