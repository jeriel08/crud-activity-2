<?php 
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if the user is not logged in
    header("Location: ../views/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../statics/style.css" rel="stylesheet">

    <!-- Stylesheets --> 
    <link rel="stylesheet" href="../statics/style.css">
    <link rel="stylesheet" href="../statics/css/bootstrap.min.css">
    
    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    
    <title>Simple Blog System | Write Blog</title>
</head>
<body>
    <div class="container d-flex flex-column align-items-center mt-5"><!-- Main Content -->
        <div class="col-12 col-md-8 col-lg-6">
            <div class="text-center">
                <p class="display-5 fw-bold">Write Content</p>
            </div>

            <form class="form" action="../handlers/add-blog-handler.php" method="POST">
                <div class="my-3">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" required>
                </div>
                <!-- Set the logged-in username as the default value for the author -->
                <div class="my-3">
                    <label for="author">Author</label>
                    <input type="text" class="form-control" name="author" value="<?= htmlspecialchars($_SESSION['username']); ?>" readonly>
                </div>
                <div class="my-3">
                    <label>Content</label>
                    <textarea class="form-control" style="min-height: 15rem;" name="content" required></textarea>
                </div>

                <!-- Buttons: Post & Back -->
                <div class="my-4">
                    <button type="submit" class="btn custom-btn btn-outline-dark btn-sm d-flex align-items-center justify-content-center gap-2">
                        <i class="bx bx-upload fs-4"></i>
                        <span>Post Blog</span>
                    </button>
                    <br>
                    <a href="mainpage.php" class="btn btn-outline-secondary mt-3">&larr; Back</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script src="../statics/js/bootstrap.min.js"></script>
</body>

</html>
