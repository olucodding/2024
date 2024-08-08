<?php
// Include database connection
require_once 'db.php';

// Process registration form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the password using bcrypt
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL query to insert user into database
    $query = $db->prepare("INSERT INTO users (username, password_hash) VALUES (:username, :password_hash)");
    $query->bindParam(':username', $username);
    $query->bindParam(':password_hash', $hashed_password);

    // Execute query
    if ($query->execute()) {
        echo "User registered successfully!";
    } else {
        echo "Error registering user.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
</head>
<body>
    <h2>Register New User</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="Register">
    </form>
</body>
</html>
