<?php
session_start();

// Destroy all session variables
session_unset();

// Remove the token from the session
unset($_SESSION['access_token']);

// Clear the cookie (expire it)
setcookie("access_token", "", time() - 3600, "/"); // Expire the cookie by setting the time in the past

// Destroy the session
session_destroy();

// Redirect to login page
header("Location: ../index.php");
exit();
?>
