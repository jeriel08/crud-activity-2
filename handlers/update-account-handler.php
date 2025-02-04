<?php
session_start(); // Start the session
include "../database/database.php";

try {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['errors'] = "Unauthorized access. Please log in.";
            header("Location: ../index.php");
            exit;
        }

        // Retrieve user input
        $id = $_SESSION['user_id']; // Get logged-in user's ID
        $username = trim($_POST['username']);
        $password = trim($_POST['password']); // This is for confirmation only
        $confirm_password = trim($_POST['confirm_password']); 
        $fname = trim($_POST['fname']);
        $lname = trim($_POST['lname']);

        // Fetch user from the database
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if (!$user) {
            $_SESSION['errors'] = "User not found.";
            header("Location: ../views/account_page.php");
            exit;
        }

        // Verify entered password matches stored password
        if (!password_verify($password, $user['password'])) {
            $_SESSION['errors'] = "Incorrect password. Please enter your current password.";
            header("Location: ../views/account_page.php");
            exit;
        }

        // Ensure confirmation password matches
        if ($password !== $confirm_password) {
            $_SESSION['errors'] = "Password confirmation does not match.";
            header("Location: ../views/account_page.php");
            exit;
        }

        // Update user details (excluding password)
        $stmt = $conn->prepare("UPDATE users SET username = ?, fname = ?, lname = ? WHERE id = ?");
        $stmt->bind_param("sssi", $username, $fname, $lname, $id);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Account updated successfully.";
            header("Location: ../views/account_page.php");
            exit;
        } else {
            $_SESSION['errors'] = "Failed to update account.";
        }
    }
} catch (Exception $e) {
    $_SESSION['errors'] = "Error: " . $e->getMessage();
}

// Redirect back in case of errors
header("Location: ../views/account.php");
exit;
?>
