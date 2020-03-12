<?php
require_once('database.php');
// Get IDs
$wearable_id = filter_input(INPUT_POST, 'wearable_id', FILTER_VALIDATE_INT);
$wearablecategory_id = filter_input(INPUT_POST, 'wearablecategory_id', FILTER_VALIDATE_INT);
// Delete the wearable from the database
if ($wearable_id != false && $wearablecategory_id != false) {
    $query = "DELETE FROM wearables
              WHERE wearableID = :wearable_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':wearable_id', $wearable_id);
    $statement->execute();
    $statement->closeCursor();
}
// display the Wearables
include('wearables.php');
?>