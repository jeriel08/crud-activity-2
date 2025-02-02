<?php
    include '../database/database.php';

    try{
        if($_SERVER['REQUEST_METHOD']=='POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $author = $_POST['author'];

            $stmt = $conn->prepare("INSERT INTO posts (title, author, content, created_at) VALUES (?, ?, ?, NOW())"); 

            $stmt->bind_param("sss", $title, $author, $content);

            if($stmt->execute()) {
                header("Location: ../index.php");
                exit;
            } else {
                echo "operation failed.";
            }
        }

    } catch(\Exception $e) {
        echo "Error: " . $e;
    }

?>