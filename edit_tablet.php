<?php
// Get the data
$tablet_id = filter_input(INPUT_POST, 'tablet_id', FILTER_VALIDATE_INT);
$tabletcategory_id = filter_input(INPUT_POST, 'tabletcategory_id', FILTER_VALIDATE_INT);
$code = filter_input(INPUT_POST, 'code');
$name = filter_input(INPUT_POST, 'name');
$description = filter_input(INPUT_POST, 'description');
$colour = filter_input(INPUT_POST, 'colour');
$storage = filter_input(INPUT_POST, 'storage');
$stockQty = filter_input(INPUT_POST, 'stockQty');
$price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
// Validate inputs
if ($tablet_id == NULL || $tablet_id == FALSE || $tabletcategory_id == NULL || $tabletcategory_id == FALSE || empty($code) || empty($name) || empty($description) || empty($colour) || empty($storage) || $price == NULL || $price == FALSE) {
$error = "Invalid data. Check all fields and try again.";
include('error.php');
} else {
// Image upload
$imgFile = $_FILES['image']['name'];
$tmp_dir = $_FILES['image']['tmp_name'];
$imgSize = $_FILES['image']['size'];
$original_image = filter_input(INPUT_POST, 'original_image');
if ($imgFile) {
$upload_dir = 'image_uploads/'; // upload directory	
$imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
$image = rand(1000, 1000000) . "." . $imgExt;
if (in_array($imgExt, $valid_extensions)) {
if ($imgSize < 5000000) {
if (filter_input(INPUT_POST, 'original_image') !== "") {
unlink($upload_dir . $original_image);                    
}
move_uploaded_file($tmp_dir, $upload_dir . $image);
} else {
$errMSG = "Sorry, your file is too large it should be less then 5MB";
}
} else {
$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
}
} else {
// If no image selected the old image remain as it is.
$image = $original_image; // old image from database
}
// End Image upload

// If valid, update the tablets in the database
require_once('database.php');
$query = 'UPDATE tablets
SET tabletcategoryID = :tabletcategory_id,
code = :code,
name = :name,
description = :description,
colour = :colour,
storage = :storage,
stockQty = :stockQty,
price = :price,
image = :image
WHERE tabletID = :tablet_id';
$statement = $db->prepare($query);
$statement->bindValue(':tabletcategory_id', $tabletcategory_id);
$statement->bindValue(':code', $code);
$statement->bindValue(':name', $name);
$statement->bindValue(':description', $description);
$statement->bindValue(':colour', $colour);
$statement->bindValue(':storage', $storage);
$statement->bindValue(':stockQty', $stockQty);
$statement->bindValue(':price', $price);
$statement->bindValue(':image', $image);
$statement->bindValue(':tablet_id', $tablet_id);
$statement->execute();
$statement->closeCursor();
// Display the tablets page
include('tablets.php');
}
?>