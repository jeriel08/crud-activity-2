<?php
include '../database/database.php';

try {
    $id = $_GET['id'];

    // Fetch the post along with the author's name by joining with the users table
    $stmt = $conn->prepare("SELECT p.*, u.username AS author FROM posts p
                            JOIN users u ON p.author_id = u.id
                            WHERE p.id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $post = $result->fetch_assoc();
    } else {
        die("Post not found");
    }
    $stmt->close();
} catch (\Exception $e) {
    echo "Error: " . $e;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Stylesheets --> 
    <link rel="stylesheet" href="../statics/style.css">
    <link rel="stylesheet" href="../statics/css/bootstrap.min.css">
    
    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    <title>Jeriel Blog | <?= htmlspecialchars($post['title']); ?> </title>
</head>
<body>
    <div class="container d-flex justify-content-center my-5 px-3">
        <div class="col-12 col-md-10 col-lg-8 mx-auto">
            <div class="row text-center">
                <p class="display-5 fw-bold">Edit Post</p>
            </div>
            <div class="row">
                <form class="form" action="../handlers/edit-blog-handler.php" method="POST">
                    <input name="id" value="<?= $post['id'] ?>" hidden>
                    
                    <div class="my-3">
                        <label>Title</label>
                        <input class="form-control" type="text" name="title" value="<?= $post['title']?>" required/>
                    </div>
                    
                    <div class="my-3">
                        <label>Author</label>
                        <input type="text" class="form-control" name="author" value="<?= $post['author']?>" disabled required>
                    </div>
                    
                    <div class="my-3">
                        <label>Content</label>
                        <textarea class="form-control" style="min-height: 15rem;" name="content"><?= $post['content']?></textarea>
                    </div>
                    
                    <div class="my-3">
                        <button type="submit" class="btn custom-btn btn-outline-dark btn-sm d-flex align-items-center justify-content-center gap-2">
                            <i class='bx bx-save fs-4' ></i>
                            <span>Save Post</span>
                        </button>
                    </div>

                </form>
            </div>
            <!-- Buttons (Save and Back) -->
             <div class="mt-2">
                 <a href="mainpage.php" class="btn btn-outline-secondary mt-2">&larr; Back</a>
             </div>
        </div>  
    </div>

    <!-- Scripts -->
    <script src="statics/script.js"></script>
    <script src="../statics/js/bootstrap.min.js"></script>
</body>
</html>
