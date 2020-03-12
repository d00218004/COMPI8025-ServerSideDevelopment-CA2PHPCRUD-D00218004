<?php
// Get ID
$wearablecategory_id = filter_input(INPUT_POST, 'wearablecategory_id', FILTER_VALIDATE_INT);
// Validate inputs
if ($wearablecategory_id == null || $wearablecategory_id == false) {
    $error = "Invalid wearable category ID.";
    include('error.php');
} else {
    require_once('database.php');
    // Delete the phwearablesones from the database  
    $query = 'DELETE FROM wearablecategories 
              WHERE wearablecategoryID = :wearablecategory_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':wearablecategory_id', $wearablecategory_id);
    $statement->execute();
    $statement->closeCursor();
    // Display the Wearable Category List page
    include('wearable_category_list.php');
}
?>
