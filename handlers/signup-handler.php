<?php
include '../database/database.php';

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get input data from the form
        $username = $_POST['username'];

        // Validate input (e.g., check if username already exists)
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // If username already exists, show an error
        if ($result->num_rows > 0) {
            echo "Username already taken. Please choose a different one.";
        } else {
            // Insert the new user into the users table
            $stmt = $conn->prepare("INSERT INTO users (username) VALUES (?)");
            $stmt->bind_param("s", $username);

            if ($stmt->execute()) {
                // Redirect to login page after successful registration
                header("Location: ../index.php");
                exit;
            } else {
                echo "Registration failed. Please try again.";
            }
        }
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
