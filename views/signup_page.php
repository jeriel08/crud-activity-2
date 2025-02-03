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
        <div class="row d-flex justify-content-center align-items-center mx-auto my-auto py-5 px-5">
            <div class="col-lg-5 my-5 border rounded-5 p-5 shadow-lg">
                <div class="text-center">
                    <p class="display-5 fw-bold">Signup</p>
                </div>
                <div class="row">
                    <form action="../handlers/signup-handler.php" method="POST" class="form">
                        <?php if (isset($_SESSION['errors'])): ?>
                            <div class="alert alert-danger">
                                <?php
                                echo $_SESSION['errors'];
                                unset($_SESSION['errors']);
                                ?>
                            </div>
                        <?php endif; ?>
                        <div class="row mt-4 p-0">
                            <div class="col-6 md-2">
                                <label for="fname">First Name</label>
                                <input class="form-control mt-1" type="text" name="fname" required placeholder="First Name">
                            </div>
                            <div class="col-6">
                                <label for="lname">Last Name</label>
                                <input class="form-control mt-1" type="text" name="lname" required placeholder="Last Name">
                            </div>
                        </div>
                        <div class="row mt-2 p-2">
                            <label for="username">Username</label>
                            <input class="form-control mt-1" type="text" name="username" required placeholder="Enter your username">
                        </div>
                        <div class="row mt-2 p-2">
                            <label for="password">Password</label>
                            <input class="form-control mt-1" type="password" name="password" required placeholder="Enter your password">
                        </div>
                        <div class="row mt-2 mb-5 p-2">
                            <label for="confirm_password"> Confirm Password</label>
                            <input class="form-control mt-1" type="password" name="confirm_password" required placeholder="Confirm password">
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