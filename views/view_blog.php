<?php include '../database/database.php'; ?>

<?php
try {
    $id = $_GET['id'] ?? null;

    if (!$id) {
        die("Invalid post ID.");
    }

    $stmt = $conn->prepare("SELECT * FROM posts WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $post = $result->fetch_assoc();
    } else {
        die("Post not found");
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
    <link rel="stylesheet" href="../statics/css/bootstrap.min.css">
    <link rel="stylesheet" href="../statics/style.css">
    <script src="../statics/js/bootstrap.min.js"></script>
    <title>Jeriel Blog | <?= htmlspecialchars($post['title']); ?></title>
</head>
<body>
    <div class="container d-flex flex-column align-items-center my-5">
        <div class="col-12 col-md-8 col-lg-6">
            <!-- Blog Title -->
            <div class="text-center">
                <p class="display-5 fw-bold"><?= htmlspecialchars($post['title']); ?></p>
                <p class="small">Written By <?= htmlspecialchars($post['author']); ?></p>
            </div>

            <!-- Blog Content -->
            <div class="mt-3 mb-5 p-3">
                <p><?= nl2br(htmlspecialchars($post['content'])); ?></p>
            </div>

            <!-- Buttons Section -->
            <div class="d-flex flex-column">
                <div class="d-flex gap-2">
                    <a href="edit_blog.php?id=<?= $post['id']; ?>" class="btn btn-warning">Edit</a>
                    <a href="../handlers/delete-blog-handler.php?id=<?=$post['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?');">Delete</a>
                </div>
                <div>
                    <a href="../index.php" class="btn btn-outline-secondary mt-3">&larr; Back</a>
                </div>
                
            </div>
        </div>
    </div>
</body>


</html>
