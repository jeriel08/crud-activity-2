<?php
include '../database/database.php';
include '../helpers/authenticated.php';

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
    
    <!-- Stylesheets --> 
    <link rel="stylesheet" href="../statics/style.css">
    <link rel="stylesheet" href="../statics/css/bootstrap.min.css">
    
    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    <title>Welcome | Simple Blog System</title>
</head>
<body>
    <div class="container d-flex justify-content-center my-5 px-4 px-md-0">
        <div class="col-12 col-md-8 col-lg-6 mx-auto">
            <div class="row text-center">
                <p class="display-4 fw-bold">Simple Blog System</p>
                <p>By Jeriel Sanao</p>
            </div>
            
            <!-- Show the logged-in user's username -->
            <div class="row text-center">
                <p class="fw-bold">Welcome, <?= htmlspecialchars($_SESSION['username']); ?>!</p>
            </div>

            <div class="row mt-2 mb-5">
                <div class="col-6 text-end">
                    <a href="account_page.php" class="btn btn-outline-warning py-2 px-4">Account</a>
                </div>
                <div class="col-3 text-first">
                    <a href="../handlers/logout-handler.php" class="btn btn-outline-danger d-flex align-items-center justify-content-center gap-2">
                        <i class="bx bx-log-out fs-3"></i>
                        <span>Logout</span>
                    </a>
                </div>
                
            </div>

            <div class="row my-4">
                <div class="col">
                <a href="add_blog.php" class="btn custom-btn btn-outline-dark btn-sm d-flex align-items-center justify-content-center gap-2">
    <i class="bx bx-book-add fs-3"></i>
    <span>Write a blog</span>
</a>
                </div>
            </div>
            
            <div class="row mt-5 text-center ">
                <p class="fw-bold d-flex align-items-center justify-content-center gap-2">
                    <i class='bx bx-book-content fs-3' ></i>
                    Contents
                </p>
            </div>

            <?php
                $res = $conn->query("SELECT posts.*, users.username FROM posts JOIN users on posts.author_id = users.id");  
            ?>
            <?php if($res -> num_rows > 0): ?>
                <?php while($row = $res -> fetch_assoc()): ?>
                    <div class="row border rounded p-3 my-4 post-card d-flex justify-content-center align-items-center">
                        <div class="row mt-2">
                            <div class="row d-flex align-items-center">
                                <div class="col-auto">
                                    <h5 class="fw-bold mb-0"><?= htmlspecialchars($row['title']); ?></h5>
                                </div>
                                <div class="col-auto">
                                    <span class="text-muted small">by <?= htmlspecialchars($row['username']); ?></span>
                                </div>
                            </div>
                            <span class="text-muted small" style="font-size: 0.9rem;">
                                Published on: <?= date('Y-m-d', strtotime($row['created_at'])); ?>
                            </span>
                        </div>
                        <div class="row mt-3 mb-2 text-center">
                            <a href="view_blog.php?id=<?=$row['id'];?>" class="btn btn-sm btn-warning d-flex align-items-center justify-content-center gap-2">
                                <i class='bx bx-book-open' ></i>
                                <span>View</span>
                            </a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="row border rounded p-3 my-3 text-center">
                    <div class="col mt-3">
                        <p class="text-muted">There's no content yet. 😥</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Scripts -->
    <script src="../statics/js/bootstrap.js"></script>
</body>
</html>
