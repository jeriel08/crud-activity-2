<?php
  include "../database/database.php";
  session_start(); // Start the session to check the logged-in user

  try
  {
    if($_SERVER['REQUEST_METHOD'] == "POST"){
      $title = $_POST['title'];
      $content = $_POST['content'];
      $id = $_POST['id'];

      // Fetch the post to check the author
      $stmt = $conn->prepare("SELECT p.*, u.username AS author FROM posts p
                            JOIN users u ON p.author_id = u.id
                            WHERE p.id = ?");
      $stmt->bind_param("i", $id);
      $stmt->execute();
      $result = $stmt->get_result();
      $post = $result->fetch_assoc();

      // Check if the logged-in user is the author of the post
      if ($_SESSION['username'] !== $post['author']) {
          die("You are not authorized to edit this post.");
      }

      // Update the post
      $stmt = $conn->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?"); 
      $stmt->bind_param("ssi", $title, $content, $id);

      if($stmt->execute()){
        header("Location: ../views/mainpage.php");
        exit;
      } else {
        echo "Operation failed.";
      }
    }
  }
  catch(\Exception $e){
    echo "Error: " . $e->getMessage();
  }
?>
