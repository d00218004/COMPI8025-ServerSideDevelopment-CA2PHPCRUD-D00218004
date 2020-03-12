<?php
// Get the data
$wearablecategory_id = filter_input(INPUT_POST, 'wearablecategory_id', FILTER_VALIDATE_INT);
$code = filter_input(INPUT_POST, 'code');
$name = filter_input(INPUT_POST, 'name');
$description = filter_input(INPUT_POST, 'description');
$colour = filter_input(INPUT_POST, 'colour');
$size = filter_input(INPUT_POST, 'size');
$bluetooth = filter_input(INPUT_POST, 'bluetooth');
$price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
// Validate inputs
if ($wearablecategory_id == null || $wearablecategory_id == false || $code == null || $name == null || $description == null || $colour == null || $size == null || $bluetooth == null || $price == null || $price == false) {
    $error = "Invalid data. Check all fields and try again.";
    include('error.php');
    exit();
} else {
// Image upload
    error_reporting(~E_NOTICE); 
// avoid notice
    $imgFile = $_FILES['image']['name'];
    $tmp_dir = $_FILES['image']['tmp_name'];
    echo $_FILES['image']['tmp_name'];
    $imgSize = $_FILES['image']['size'];
    if (empty($imgFile)) {
        $image = "";
    } else {
        $upload_dir = 'image_uploads/'; // upload directory
        $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension
        // valid image extensions
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
        // rename uploading image
        $image = rand(1000, 1000000) . "." . $imgExt;
        // allow valid image file formats
        if (in_array($imgExt, $valid_extensions)) {
        // Check file size '5MB'
            if ($imgSize < 5000000) {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $upload_dir . $image)) {
                    echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
                } else {
                    $error =  "Sorry, there was an error uploading your file.";
                    include('error.php');
                    exit();
                }
            } else {
                $error = "Sorry, your file is too large.";
                include('error.php');
                exit();
            }
        } else {
            $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            include('error.php');
            exit();
        }
    }
// End Image upload
    
    require_once('database.php');
    // Add the wearables to the database 
    $query = "INSERT INTO wearables
                 (wearablecategoryID, code, name, description, colour, size, bluetooth, price, image)
              VALUES
                 (:wearablecategory_id, :code, :name, :description, :colour, :size, :bluetooth, :price, :image)";
    $statement = $db->prepare($query);
    $statement->bindValue(':wearablecategory_id', $wearablecategory_id);
    $statement->bindValue(':code', $code);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':description', $description);
    $statement->bindValue(':colour', $colour);
    $statement->bindValue(':size', $size);
    $statement->bindValue(':bluetooth', $bluetooth);
    $statement->bindValue(':price', $price);
    $statement->bindValue(':image', $image);
    $statement->execute();
    $statement->closeCursor();
// Display the wearables List page
    include('wearables.php');
}