<?php

include 'functions.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Motorparts Inventory</title>
</head>

 <style>
body {
    font-family: 'Roboto', sans-serif;
    margin: 0;
    padding: 0;
    background-image: url(img/img11.jpg);
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
}

header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #333;
    color: #fff;
    padding: 20px;
}

nav ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
}

nav ul li {
    display: inline;
    margin-right: 20px;

}

nav ul li a {
    color: #fff;
    text-decoration: none;
    font-size: 16px;
    cursor: pointer;
     border: 1px solid #ddd;
        border-radius: 10px;
        padding: 20px;

}
.logo h1{
    font-size: 30px;
    padding-left: 20px;

}

nav ul li a:hover {
    text-decoration: underline;
}

.logo {
    display: flex;
    align-items: center;

}

.logo img {
    height: 40px;
    margin-right: 10px;
    border-radius: 50%;
}

h1 {
    margin: 0;
    font-size: 2.5rem;
}

section {
    margin-left: 50px;
    margin-right: 50px;
    background: lightsteelblue;
    border-radius: 5px;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.8);
    margin-bottom: 100px;
    padding-left: 100px;
    padding-right: 100px;
}

h2 {
    margin-top: 0;
    color: #007bff;
}

.form label {
    display: block;
    margin: 10px 0 5px;
}

input[type="text"],
input[type="number"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ced4da;
    border-radius: 4px;
    box-sizing: border-box;
}

button {
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #0056b3;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

th, td {
    border: 1px solid #dee2e6;
    padding: 12px;
    text-align: left;
}

th {
    background-color: #e9ecef;
}

.alert {
    background-color: #f44336;
    color: white;
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 4px;
}

@media (max-width: 768px) {
    .container {
        padding: 10px;
    }

    header {
        padding: 15px 0;
    }

    h1 {
        font-size: 2rem;
    }

    section {
        padding: 15px;
    }
}
    </style>

<body>
        <header>
    
        <div class="logo">
            <img src="img/img1.png" alt="Logo">
            <h1>Motor Parts Inventory System</h1>
            </div>
        <nav class=>
            
            <ul>

                <li><a href="index.php">Home</a></li>
                <li><a href="developers.php">Web Developers</a><li>
                <li><a href="about.php">About</a></li>
                <li><a href="logout.php">Logout </a><li>
            </ul>
        </nav>
        </div>
    </header><br><br><br>
 <div class="container">
    <div class="con1">
        <section class="card">
            <h2>Add Product</h2>
            <form action="add_product.php" method="post" class="form">
                <label>Name: <input type="text" name="name" required></label>
                <label>SKU: <input type="text" name="sku" required></label>
                <label>Price: <input type="number" step="0.01" name="price" required></label>
                <label>Quantity: <input type="number" name="quantity" required></label>
                <label>Barcode: <input type="text" name="barcode" required></label>
                <label>Details:<input type="text" =name="details" required></label>
                <button type="submit">Add Product</button>
            </form>
        </section>
    </div>


        <section class="card">
            <h2>Sell Product</h2>
            <form action="sell_product.php" method="post" class="form">
                <label>Product ID: <input type="number" name="product_id"></label>
                <label>Barcode: <input type="text" name="barcode" id="barcode"></label>
                <label>Quantity: <input type="number" name="quantity" required></label>
                <button type="submit">Sell Product</button>
            </form>
        </section>

        <section class="card">
            <h2>Inventory</h2>
            <div class="table-container">
                
                <?php
                $products = getProducts();
                if ($products->num_rows > 0) {
                    echo "<table><tr><th>ID</th><th>Name</th><th>SKU</th><th>Price</th><th>Quantity</th><th>Barcode</th></tr>";
                    while($row = $products->fetch_assoc()) {
                        echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name"]. "</td><td>" . $row["sku"]. "</td><td>" . $row["price"]. "</td><td>" . $row["quantity"]. "</td><td>" . $row["barcode"]. "</td></tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>No products available</p>";
                }
                ?>
            </div>
        </section>

        <section class="card">
            <h2>Out of Stock Items</h2>
            <div class="table-container">
                <?php
                $outOfStockItems = getOutOfStockItems();
                if ($outOfStockItems->num_rows > 0) {
                    echo "<table><tr><th>ID</th><th>Name</th><th>SKU</th><th>Price</th><th>Quantity</th><th>Barcode</th></tr>";
                    while($row = $outOfStockItems->fetch_assoc()) {
                        echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name"]. "</td><td>" . $row["sku"]. "</td><td>" . $row["price"]. "</td><td>" . $row["quantity"]. "</td><td>" . $row["barcode"]. "</td></tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>No out of stock items</p>";
                }
               ?>
            </div>
        </section>

        <section class="card">
            <h2>Stock Alert</h2>
            <div class="table-container">
                <?php
                $stockAlertItems = getStockAlertItems(5); // Set threshold as 5
                if ($stockAlertItems->num_rows > 0) {
                    echo "<table><tr><th>ID</th><th>Name</th><th>SKU</th><th>Price</th><th>Quantity</th><th>Barcode</th></tr>";
                    while($row = $stockAlertItems->fetch_assoc()) {
                        echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name"]. "</td><td>" . $row["sku"]. "</td><td>" . $row["price"]. "</td><td>" . $row["quantity"]. "</td><td>" . $row["barcode"]. "</td></tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>No stock alert items</p>";
                }
                ?>
            </div>
        </section>
    </div>
</body>
</html>
