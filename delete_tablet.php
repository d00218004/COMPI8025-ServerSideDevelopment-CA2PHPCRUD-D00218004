<?php
require_once('database.php');
// Get IDs
$tablet_id = filter_input(INPUT_POST, 'tablet_id', FILTER_VALIDATE_INT);
$tabletcategory_id = filter_input(INPUT_POST, 'tabletcategory_id', FILTER_VALIDATE_INT);
// Delete the Tablet from the database
if ($tablet_id != false && $tabletcategory_id != false) {
    $query = "DELETE FROM tablets
              WHERE tabletID = :tablet_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':tablet_id', $tablet_id);
    $statement->execute();
    $statement->closeCursor();
}
// display the Homepage
include('tablets.php');
?>