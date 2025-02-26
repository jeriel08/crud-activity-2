<?php include 'helpers/not_authenticated.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="statics/css/bootstrap.min.css" >
    <link rel="stylesheet" href="statics/style.css" >
    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    <title>Simple Blog System | Login</title>
</head>
<body>
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center my-5 py-5">
            <div class="col-lg-4 my-5 border rounded-5 p-5 shadow-lg">
                <div class="text-center">
                    <p class="display-5 fw-bold">Login</p>
                </div>
                <div class="row">
                    <form action="handlers/login-handler.php" method="POST" class="form">
                        <?php if (isset($_SESSION['errors'])): ?>
                            <div class="alert alert-danger">
                                <?php
                                echo $_SESSION['errors'];
                                unset($_SESSION['errors']);
                                ?>
                            </div>
                        <?php endif; ?>
                        <div class="row mt-4">
                            <label for="username">Username</label>
                            <div class="input-group mt-1">
                                <span class="input-group-text">
                                    <i class='bx bx-user-circle fs-4'></i>
                                </span>
                                <input class="form-control" type="text" name="username" required placeholder="Enter your username" id="username">
                            </div>
                        </div>
                        <div class="row mt-4 mb-5">
                            <label for="password">Password</label>
                            <div class="input-group mt-1">
                                <span class="input-group-text">
                                    <i class='bx bx-lock  fs-5'></i>
                                </span>
                                <input class="form-control" type="password" name="password" required placeholder="Enter your password" id="password">

                            </div>
                        </div>

                        <div class="mt-3 d-flex flex-column align-items-center">
                            <button class="btn btn-outline-dark px-4 py-2" type="submit">Login</button>
                            <a href="views/signup_page.php" class="mt-3" style="text-decoration: none;"><small>Create an account</small></a>
                        </div>
                    </form>
                </div> 
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="statics/js/bootstrap.min.js"></script>
</body>
</html>