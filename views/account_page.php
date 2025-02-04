<?php 

include '../database/database.php';
include '../helpers/authenticated.php';

try {
    if (!isset($_SESSION['user_id'])) {
        die("User not authenticated.");
    }

    $id = $_SESSION['user_id']; // Get logged-in user's ID

    $stmt = $conn->prepare('SELECT * FROM users WHERE id = ?');
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $user = $result -> fetch_assoc();
    } else {
        die("User not found.");
    }
    $stmt -> close();
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
    <title>Simple Blog System | Account Settings</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center align-items-center py-5">
            <div class="col-lg-10 border rounded-5 p-4 shadow-lg">
                <div class="text-center mb-4">
                    <p class="display-5 fw-bold">Account Settings</p>
                </div>
                <div class="row">
                    <!-- Account Information Form -->
                    <div class="col-12 col-md-6 mb-4">
                        <div class="card p-4">
                            <h4 class="text-center fw-bold">Update Account</h4>
                            <form action="../handlers/update-account-handler.php" method="POST">
                                <?php if (isset($_SESSION['errors'])): ?>
                                    <div class="alert alert-danger">
                                        <?php
                                        echo $_SESSION['errors'];
                                        unset($_SESSION['errors']);
                                        ?>
                                    </div>
                                <?php elseif (isset($_SESSION['success'])): ?>
                                    <div class="alert alert-success">
                                        <?php
                                        echo $_SESSION['success'];
                                        unset($_SESSION['success']);
                                        ?>
                                    </div>
                                <?php endif; ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="fname">First Name</label>
                                        <input class="form-control mt-1" type="text" name="fname" required placeholder="First Name" value="<?= htmlspecialchars($user['fname']) ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="lname">Last Name</label>
                                        <input class="form-control mt-1" type="text" name="lname" required placeholder="Last Name" value="<?= htmlspecialchars($user['lname']) ?>">
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <label for="username">Username</label>
                                    <input class="form-control mt-1" type="text" name="username" required placeholder="Enter your username" value="<?= htmlspecialchars($user['username']) ?>">
                                </div>
                                <div class="mt-2">
                                    <label for="password">Password</label>
                                    <input class="form-control mt-1" type="password" name="password" required placeholder="Enter your password">
                                </div>
                                <div class="mt-2">
                                    <label for="confirm_password">Confirm Password</label>
                                    <input class="form-control mt-1" type="password" name="confirm_password" required placeholder="Confirm password">
                                </div>
                                <div class="mt-3 d-flex flex-column align-items-center">
                                    <button class="btn btn-outline-dark w-100 py-2" type="submit">Update</button>
                                    <a href="../views/mainpage.php" class="mt-3" style="text-decoration: none;"><small>Go back</small></a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Change Password Form -->
                    <div class="col-12 col-md-6">
                        <div class="card p-4">
                            <h4 class="text-center fw-bold">Change Password</h4>
                            <form action="../handlers/change-password-handler.php" method="POST">
                                <div class="mt-2">
                                    <label for="old_password">Old Password</label>
                                    <input class="form-control mt-1" type="password" name="old_password" required placeholder="Enter your old password">
                                </div>
                                <div class="mt-2">
                                    <label for="password">New Password</label>
                                    <input class="form-control mt-1" type="password" name="password" required placeholder="Enter new password">
                                </div>
                                <div class="mt-2">
                                    <label for="confirm_password">Confirm Password</label>
                                    <input class="form-control mt-1" type="password" name="confirm_password" required placeholder="Confirm password">
                                </div>
                                <div class="mt-3 d-flex flex-column align-items-center">
                                    <button class="btn btn-outline-dark w-100 py-2" type="submit">Change Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</body>

</html>