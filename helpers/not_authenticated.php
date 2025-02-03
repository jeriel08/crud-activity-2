<?php

session_start();

echo "Session Access Token: " . ($_SESSION['access_token'] ?? 'NOT SET') . "<br>";
echo "Cookie Access Token: " . ($_COOKIE['access_token'] ?? 'NOT SET') . "<br>";

if (isset($_SESSION['access_token']) || isset($_COOKIE['access_token'])) {
    echo "✅ Already authenticated! Redirecting to mainpage.php...";
    exit; // Prevent redirection for debugging
    header("Location: ../views/mainpage.php");
    exit;
} else {
    echo "❌ Not authenticated! Redirecting to login.php...";
    exit;
    header("Location: ../views/login.php");
    exit;
}


?>