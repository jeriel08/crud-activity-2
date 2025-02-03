<?php
include '../database/database.php';
session_start();

try {
    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        // Redirect to login page if the user is not logged in
        header("Location: ../views/login.php");
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get the input values from the form
        $title = $_POST['title'];
        $content = $_POST['content'];
        
        // Get the author_id from session (assuming the user's ID is stored in the session)
        $author_id = $_SESSION['user_id'];  // Make sure user_id is set during login

        // Prepare the SQL query to insert the blog post
        $stmt = $conn->prepare("INSERT INTO posts (title, author_id, content, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("sis", $title, $author_id, $content);  // "s" for string, "i" for integer (author_id)

        // Execute the query and check if successful
        if ($stmt->execute()) {
            // Redirect to mainpage after successful post
            header("Location: ../views/mainpage.php");
            exit();
        } else {
            echo "Operation failed.";
        }
    }

} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
