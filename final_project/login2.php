<?php
session_start();
include 'config.php'; // Include your database connection file
$username;
$password;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to check if the user exists
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verify the password
        // if (password_verify($password, $username['password'])) {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['username'])) {
                $username = $_POST['username'];
            } else {
                $error = "Username is required.";
            }
        
            if (isset($_POST['password'])) {
                $password = $_POST['password'];
            } else {
                $error = "Password is required.";
            }
        }


            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role_id'];

            // Redirect based on role
            switch ($user['role_id']) {
                case 1: // Admin
                    header("Location: admin/admin_dashboard.php");
                    break;
                case 2: // Manager
                    header("Location: manager/manager_dashboard.php");
                    break;
                case 3: // User
                    header("Location: user_dashboard.php");
                    break;
            }
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No user found with that username. Kindly create an account";
    }
    $conn->close();

?>
