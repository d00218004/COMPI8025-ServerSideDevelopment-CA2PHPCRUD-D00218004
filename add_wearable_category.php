<?php
// Get the category data
$name = $name = filter_input(INPUT_POST, 'name');
// Validate inputs
if ($name == null) {
    $error = "Invalid category data. Check all fields and try again.";
    include('error.php');
} else {
    require_once('database.php');
    // Add the wearable to the database
    $query = "INSERT INTO wearablecategories (wearablecategoryName)
              VALUES (:name)";
    $statement = $db->prepare($query);
    $statement->bindValue(':name', $name);
    $statement->execute();
    $statement->closeCursor();
    // Display the Wearable Category List page
    include('wearable_category_list.php');
}
?>