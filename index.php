<?php include 'database/database.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="statics/css/bootstrap.min.css">
    <link rel="stylesheet" href="statics/style.css">
    <script src="statics/script.js"></script>
    <script src="statics/js/bootstrap.min.js"></script>
    <title> Jeriel Blog </title>
</head>
<body>
    <div class="container d-flex justify-content-center my-5 px-4 px-md-0">
        <div class="col-12 col-md-8 col-lg-6 mx-auto">
            <div class="row text-center">
                <p class="display-5 fw-bold">Simple Blog System</p>
                <p>By Jeriel Sanao</p>
            </div>
            <div class="row my-4">
                <a href="views/add_blog.php" class="btn btn-outline-dark btn-sm">Write a blog</a>
            </div>
            <?php
                $res = $conn->query("SELECT * FROM posts");  
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
                                <span class="text-muted small">by <?= htmlspecialchars($row['author']); ?></span>
                            </div>
                        </div>
                        <span class="text-muted small" style="font-size: 0.9rem;">
                            Published on: <?= date('Y-m-d', strtotime($row['created_at'])); ?>
                        </span>
                    </div>
                    <div class="row mt-3 mb-2 text-center">
                        <a href="views/view_blog.php?id=<?=$row['id'];?>" class="btn btn-sm btn-warning">View</a>
                    </div>
                </div>
                <?php endwhile;?>
            <?php else: ?>
                <div class="row border rounded p-3 my-3 text-center">
                    <div class="col mt-3">
                        <p class="text-muted">There's no content yet. 😥</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>