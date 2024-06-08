<?php
include 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = isset($_POST['product_id']) ? $_POST['product_id'] : null;
    $barcode = isset($_POST['barcode']) ? $_POST['barcode'] : null;
    $quantitySold = isset($_POST['quantity']) ? $_POST['quantity'] : null;

    if ($barcode) {
        // Fetch product ID based on barcode
        $productResult = $conn->query("SELECT id FROM products WHERE barcode='$barcode'");
        if ($productResult->num_rows > 0) {
            $product = $productResult->fetch_assoc();
            $productId = $product['id'];
        } else {
            echo "Product not found.";
            exit;
        }
    }

    if ($productId && $quantitySold) {
        if (sellProduct($productId, $quantitySold)) {
            echo "Product sold successfully.";
        } else {
            echo "Error selling product.";
        }
    } else {
        echo "Invalid input.";
    }
}
?>