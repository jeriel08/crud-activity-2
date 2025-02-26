<?php include '../database/database.php'; ?>

<?php

session_start();

try {
    $id = $_GET['id'] ?? null;

    if (!$id) {
        die("Invalid post ID.");
    }

    // Fetch post along with the author's username by joining the posts table and users table
    $stmt = $conn->prepare("SELECT posts.*, users.username FROM posts JOIN users ON posts.author_id = users.id WHERE posts.id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $post = $result->fetch_assoc();
    } else {
        die("Post not found.");
    }
    $stmt->close();
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
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
    
    <title>Jeriel Blog | <?= htmlspecialchars($post['title']); ?></title>
</head>
<body>
    <div class="container d-flex flex-column align-items-center my-5">
        <div class="col-12 col-md-8 col-lg-6">
            <!-- Blog Title -->
            <div class="text-center">
                <p class="display-5 fw-bold"><?= htmlspecialchars($post['title']); ?></p>
                <p class="small">Written By <?= htmlspecialchars($post['username']); ?></p> <!-- Display the author's name -->
            </div>

            <!-- Blog Content -->
            <div class="mt-3 mb-5 p-3">
                <p><?= nl2br(htmlspecialchars($post['content'])); ?></p>
            </div>

            <!-- Buttons Section (optional) -->
            <div class="d-flex flex-column">
                <!-- Add Edit and Delete buttons only for logged-in users or admins (adjust logic as needed) -->
                <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post['author_id']): ?>
                    <div class="d-flex gap-2">
                        <a href="edit_blog.php?id=<?= $post['id']; ?>" class="btn btn-warning d-flex justify-content-center align-items-center gap-2">
                            <i class='bx bx-edit fs-5' ></i>
                            <span>Edit</span>
                        </a>
                        <a href="../handlers/delete-blog-handler.php?id=<?= $post['id']; ?>" class="btn btn-danger d-flex justify-content-center align-items-center gap-2" onclick="return confirm('Are you sure you want to delete this post?');">
                            <i class='bx bx-trash-alt' ></i>
                            <span>Delete</span>
                        </a>
                    </div>
                <?php endif; ?>
                <div>
                    <a href="mainpage.php" class="btn btn-outline-secondary mt-3">&larr; Back</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="../statics/js/bootstrap.min.js"></script>
</body>
</html>
