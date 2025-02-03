<?php
session_start(); // Start the session to store user info

include '../database/database.php';

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get the username from the form
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = verify_user($username, $password);

    if ($user) {
      
      $_SESSION['user_id'] = $user['id'];

      // Generate a unique token
      $token = bin2hex(random_bytes(32));

      // Store the token in the session
      $_SESSION['access_token'] = $token;

      header("Location: ../views/mainpage.php");
      exit;
    } else {
      $_SESSION['errors'] = "Invalid username or password!";
      header("Location: ../index.php");
      exit;
    }
  }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}

// Function to verify user credentials
function verify_user($username, $password)
{
  global $conn;

  $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($row = $result->fetch_assoc()) {
    if (password_verify($password, $row['password'])) {
      return $row; // Return user info
    }
  }
  return false;
}


?>
