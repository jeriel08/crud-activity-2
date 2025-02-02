<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../statics/style.css" rel="stylesheet">
    <link href="../statics/css/bootstrap.min.css" rel="stylesheet">
    <script src="../statics/js/bootstrap.min.js"></script>
    <title> Jeriel Blog | Write Blog </title>
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
                <div class="my-3">
                    <label for="author">Author</label>
                    <input type="text" class="form-control" name="author" required>
                </div>
                <div class="my-3">
                    <label>Content</label>
                    <textarea class="form-control" style="min-height: 15rem;" name="content" required></textarea>
                </div>

                <!-- Buttons: Post & Back -->
                <div class="my-4">
                    <button type="submit" class="btn btn-outline-dark">Post Blog</button>
                    <br>
                    <a href="../index.php" class="btn btn-outline-secondary mt-3">&larr; Back</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>