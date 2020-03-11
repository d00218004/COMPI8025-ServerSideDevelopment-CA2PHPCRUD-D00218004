<?php
require_once('database.php');
// Get IDs
$phone_id = filter_input(INPUT_POST, 'phone_id', FILTER_VALIDATE_INT);
$phonecategory_id = filter_input(INPUT_POST, 'phonecategory_id', FILTER_VALIDATE_INT);
// Delete the phone from the database
if ($phone_id != false && $phonecategory_id != false) {
    $query = "DELETE FROM phones
              WHERE phoneID = :phone_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':phone_id', $phone_id);
    $statement->execute();
    $statement->closeCursor();
}
// display the Homepage
include('index.php');
?>