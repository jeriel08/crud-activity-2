<?php
session_start(); // Start the session to store user info

include '../database/database.php';

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get the username from the form
        $username = $_POST['username'];

        // Check if the username exists in the database
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // If the username is found, create a session for the user
        if ($result->num_rows > 0) {
            // Fetch the user data
            $user = $result->fetch_assoc();

            // Store user information in session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            // Redirect the user to the main page after successful login
            header("Location: ../views/mainpage.php");
            echo ("User found!");
            exit;
        } else {
            // If username does not exist, show an error
            echo "Username not found";
        }
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
