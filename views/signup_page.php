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
        <div class="row vh-100 d-flex justify-content-center align-items-center mx-auto">
            <div class="col-12 col-md-8 col-lg-5 border rounded-5 p-4 shadow-lg">
                <div class="text-center mt-2">
                    <p class="display-5 fw-bold">Signup</p>
                </div>
                <form action="../handlers/signup-handler.php" method="POST" class="form">
                    <?php if (isset($_SESSION['errors'])): ?>
                        <div class="alert alert-danger">
                            <?php
                            echo $_SESSION['errors'];
                            unset($_SESSION['errors']);
                            ?>
                        </div>
                    <?php endif; ?>
                    <div class="row mt-3">
                        <div class="col-12 col-md-6">
                            <label for="fname">First Name</label>
                            <input class="form-control mt-1 w-100" type="text" name="fname" required placeholder="First Name">
                        </div>
                        <div class="col-12 col-md-6 mt-2 mt-md-0">
                            <label for="lname">Last Name</label>
                            <input class="form-control mt-1 w-100" type="text" name="lname" required placeholder="Last Name">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <label for="username">Username</label>
                            <input class="form-control mt-1 w-100" type="text" name="username" required placeholder="Enter your username">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <label for="password">Password</label>
                            <input class="form-control mt-1 w-100" type="password" name="password" required placeholder="Enter your password">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <label for="confirm_password">Confirm Password</label>
                            <input class="form-control mt-1 w-100" type="password" name="confirm_password" required placeholder="Confirm password">
                        </div>
                    </div>
                    <div class="mt-4 d-flex flex-column align-items-center">
                        <button class="btn btn-outline-dark px-4 py-2" type="Submit">Signup</button>
                        <a href="../index.php" class="mt-3" style="text-decoration: none;"><small>Go back</small></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
                        
</html>