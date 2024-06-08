<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "motorparts_inventory";


$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL);
ini_set('display_errors', 1);

function getProducts() {
    global $conn;
    $result = $conn->query("SELECT * FROM products");
    return $result ? $result : false;
}

function getOutOfStockItems() {
    global $conn;
    $result = $conn->query("SELECT * FROM products WHERE quantity = 0");
    return $result ? $result : false;
}

function getStockAlertItems($threshold) {
    global $conn;
    $result = $conn->query("SELECT * FROM products WHERE quantity < $threshold");
    return $result ? $result : false;
}

function getProductBySKU($sku) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM products WHERE sku = ?");
    $stmt->bind_param("s", $sku);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    return $row; 
}

function updateProduct($id, $name, $category, $price, $quantity, $barcode, $details) {
    global $conn;
    $sql = "UPDATE products SET name=?, category=?, price=?, quantity=?, barcode=?, details=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdissi", $name, $category, $price, $quantity, $barcode, $details, $id);
    $stmt->execute();
    $stmt->close();
}

function addProduct($name, $sku, $price, $quantity, $barcode, $details) {
    global $conn;
    // Check if the SKU already exists
    $checkStmt = $conn->prepare("SELECT id FROM products WHERE sku = ?");
    $checkStmt->bind_param("s", $sku);
    $checkStmt->execute();
    $checkStmt->store_result();
    if ($checkStmt->num_rows > 0) {
        // SKU already exists, return false or handle the error as needed
        return false;
    } else {
        // SKU is unique, proceed with inserting the product
        $insertStmt = $conn->prepare("INSERT INTO products (name, sku, price, quantity, barcode, details) VALUES (?, ?, ?, ?, ?, ?)");
        $insertStmt->bind_param("ssdiss", $name, $sku, $price, $quantity, $barcode, $details);
        $insertResult = $insertStmt->execute();
        $insertStmt->close();
        return $insertResult;
    }
}

function sellProduct($productId, $quantity) {
    global $conn;
    $updateStmt = $conn->prepare("UPDATE products SET quantity = quantity - ? WHERE id = ?");
    $updateStmt->bind_param("ii", $quantity, $productId);
    $updateResult = $updateStmt->execute();
    $updateStmt->close();
    return $updateResult;
}

?>
