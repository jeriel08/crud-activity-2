<?php
session_start();
include "../database/database.php";

try {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['errors'] = "Unauthorized access.";
            header("Location: ../index.php");
            exit;
        }

        $id = $_SESSION['user_id'];
        $old_password = trim($_POST['old_password']);
        $new_password = trim($_POST['password']);
        $confirm_password = trim($_POST['confirm_password']);

        // Fetch current user
        $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if (!$user) {
            $_SESSION['errors'] = "User not found.";
            header("Location: ../views/account_page.php");
            exit;
        }

        // Verify old password
        if (!password_verify($old_password, $user['password'])) {
            $_SESSION['errors'] = "Old password is incorrect.";
            header("Location: ../views/account_page.php");
            exit;
        }

        // Check if new password matches confirmation
        if ($new_password !== $confirm_password) {
            $_SESSION['errors'] = "New password and confirm password do not match.";
            header("Location: ../views/account_page.php");
            exit;
        }

        // Hash new password
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

        // Update password
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->bind_param("si", $hashed_password, $id);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Password updated successfully.";
            header("Location: ../views/account_page.php");
            exit;
        } else {
            $_SESSION['errors'] = "Failed to update password.";
        }
    }
} catch (Exception $e) {
    $_SESSION['errors'] = "Error: " . $e->getMessage();
}

header("Location: ../views/account_page.php");
exit;
?>
