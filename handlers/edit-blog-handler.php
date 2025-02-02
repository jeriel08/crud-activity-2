<?php

  include "../database/database.php";

  try
  {

    if($_SERVER['REQUEST_METHOD']=="POST"){

      $title = $_POST['title'];
      $content = $_POST['content'];
      $id = $_POST['id'];

      $stmt = $conn->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?"); 
      
      $stmt->bind_param("ssi", $title, $content, $id);

      if($stmt->execute())
      {
        header("Location: ../index.php");
        exit;
      }
      else
      {
        echo "operation failed";
      }
    }

  }
  catch(\Exception $e)
  {
    echo "Error: ".$e;
  }


?>
