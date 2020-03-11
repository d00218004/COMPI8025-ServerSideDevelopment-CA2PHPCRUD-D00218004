<?php
// Get ID
$phonecategory_id = filter_input(INPUT_POST, 'phonecategory_id', FILTER_VALIDATE_INT);
// Validate inputs
if ($phonecategory_id == null || $phonecategory_id == false) {
    $error = "Invalid phone category ID.";
    include('error.php');
} else {
    require_once('database.php');
    // Delete the phones from the database  
    $query = 'DELETE FROM phonecategories 
              WHERE phonecategoryID = :phonecategory_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':phonecategory_id', $phonecategory_id);
    $statement->execute();
    $statement->closeCursor();
    // Display the Phone Category List page
    include('phone_category_list.php');
}
?>
