<?php
session_start();
if ($_SESSION['role'] != 3) { // Check if the user is a Customer/User
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
</head>
<body>
    <h1>Welcome, User</h1>
    <ul>
        <li><a href="view_products.php">View Products</a></li>
        <li><a href="view_inventory.php">View Inventory</a></li>
        <li><a href="create_order.php">Create Order</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</body>
</html>
