<?php
// Get ID
$tabletcategory_id = filter_input(INPUT_POST, 'tabletcategory_id', FILTER_VALIDATE_INT);
// Validate inputs
if ($tabletcategory_id == null || $tabletcategory_id == false) {
    $error = "Invalid tablet category ID.";
    include('error.php');
} else {
    require_once('database.php');
    // Delete the Tablets from the database  
    $query = 'DELETE FROM tabletcategories 
              WHERE tabletcategoryID = :tabletcategory_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':tabletcategory_id', $tabletcategory_id);
    $statement->execute();
    $statement->closeCursor();
    // Display the Tablet Category List page
    include('tablet_category_list.php');
}
?>
