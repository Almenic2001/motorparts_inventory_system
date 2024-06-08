<?php
include 'functions.php'; // Ensure the correct path

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $sku = $_POST['sku'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $barcode = $_POST['barcode'];
    $details = isset($_POST['details']) ? $_POST['details'] : '';

    // Call the function to add the product to the database
    $result = addProduct($name, $sku, $price, $quantity, $barcode, $details);
    
    // Check if the product was added successfully
    if ($result) {
        echo "Product added successfully.";
    } else {
        echo "Error adding product.";
    }
}
?>