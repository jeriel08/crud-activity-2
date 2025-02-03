<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../statics/style.css" >
    <link rel="stylesheet" href="../statics/css/bootstrap.min.css" >
    <script src="../statics/js/bootstrap.min.js"></script>
    <title>Simple Blog System | Signup</title>
</head>
<body>
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center my-5 py-5">
            <div class="col-lg-4 my-5 border rounded-5 p-5 shadow-lg">
                <div class="text-center">
                    <p class="display-5 fw-bold">Signup</p>
                </div>
                <div class="row">
                    <form action="../handlers/signup-handler.php" method="POST" class="form">
                        <div class="row mt-4 mb-5">
                            <label for="username">Username</label>
                            <input class="form-control mt-1" type="text" name="username" required placeholder="Enter your username">
                        </div>
                        <div class="mt-3 d-flex flex-column align-items-center">
                            <button class="btn btn-outline-dark px-4 py-2" type="Submit">Signup</button>
                            <a href="../index.php" class="mt-3" style="text-decoration: none;"><small>Go back</small></a>
                        </div>
                    </form>
                </div> 
            </div>
        </div>
    </div>
</body>
</html>