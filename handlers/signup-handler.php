<?php
session_start();
include '../database/database.php';
include 'helpers/not_authenticated.php';

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get input data from the form
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];


        // Check if passwords match
        if ($password !== $confirm_password) {
            $_SESSION['errors'] = "Password Mismatch!";
            header("Location: ../views/signup_page.php");
            exit;
        }

        // Check if username already exists
        if (username_exists($username)) {
            $_SESSION['errors'] = "Username already taken!";
            header("Location: ../views/signup_page.php");
            exit;
        }

        // Create an account if username does not exist
        if (create_account($username, $password, $fname, $lname)) {
            header("Location: ../index.php");
            exit;
        } else {
            $_SESSION['errors'] = "Account creation failed!";
            header("Location: ../views/signup_page.php");
            exit;
        }
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}

function username_exists($username)
{
  global $conn;

  $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
  if (!$stmt) {
    return false;
  }

  $stmt->bind_param("s", $username);
  $stmt->execute();
  $stmt->store_result();

  return $stmt->num_rows > 0;
}

function create_account($username, $password, $fname, $lname)
{
  global $conn;

  $hashed_password = password_hash($password, PASSWORD_BCRYPT);

  $stmt = $conn->prepare("INSERT INTO users (username, password, fname, lname, created_at) VALUES (?, ?, ?, ?, NOW())");
  if (!$stmt) {
    return false;
  }

  $stmt->bind_param("ssss", $username, $hashed_password, $fname, $lname);
  return $stmt->execute();
}

?>
